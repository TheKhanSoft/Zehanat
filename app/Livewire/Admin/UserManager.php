<?php

namespace App\Livewire\Admin;

use App\Enums\EmailTemplateKey;
use App\Models\User;
use App\Services\ManagedEmailSender;
use App\Services\EmailTemplateRenderer;
use App\Support\AdminPermissions;
use App\Support\PasswordResetTemplateContext;
use App\Support\SensitivePermissions;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserManager extends Component
{
    use WithPagination;

    public string $search = '';

    public string $roleFilter = 'all';

    public string $verificationFilter = 'all';

    public string $sortField = 'created_at';

    public string $sortDirection = 'desc';

    public int $perPage = 15;

    public array $selectedUsers = [];

    public bool $showFormModal = false;

    public bool $showViewModal = false;

    public bool $showImpersonateModal = false;

    public ?int $impersonateUserId = null;

    public string $impersonateUserName = '';

    public string $impersonateUserEmail = '';

    public string $impersonateUserRole = '';

    public ?int $userId = null;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $selectedRole = 'viewer';

    public bool $emailVerified = false;

    public bool $twoFactorEnabled = false;

    public bool $canViewDashboard = false;

    public string $createdAt = '';

    public function mount(): void
    {
        abort_unless(auth()->user()->can('view users'), 403);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
        $this->selectedUsers = [];
    }

    public function updatingRoleFilter(): void
    {
        $this->resetPage();
        $this->selectedUsers = [];
    }

    public function updatingVerificationFilter(): void
    {
        $this->resetPage();
        $this->selectedUsers = [];
    }

    public function updatedPerPage($value): void
    {
        $this->perPage = in_array((int) $value, [10, 15, 25, 50], true) ? (int) $value : 15;
        $this->resetPage();
        $this->selectedUsers = [];
    }

    public function sortBy(string $field): void
    {
        abort_unless(in_array($field, ['name', 'email', 'email_verified_at', 'created_at'], true), 400);

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function create(): void
    {
        abort_unless(auth()->user()->can('create users'), 403);

        $this->resetForm();
        $this->selectedRole = $this->assignableRoles()->first()?->name ?? 'viewer';
        $this->showFormModal = true;
    }

    public function viewUser(int $id): void
    {
        $user = $this->findVisibleUser($id);
        $this->fillFromUser($user);
        $this->showViewModal = true;
    }

    public function confirmImpersonation(int $id): void
    {
        $operator = auth()->user();

        abort_unless(
            $operator->hasRole('super-admin')
                && $operator->can(SensitivePermissions::USER_IMPERSONATE),
            403,
        );

        $user = $this->findVisibleUser($id);
        abort_if($user->is($operator), 422, 'You cannot impersonate your own account.');
        abort_if($user->hasRole('super-admin'), 422, 'Super-admin accounts cannot be impersonated.');
        abort_unless($user->can('view dashboard'), 422, 'This user does not have admin dashboard access.');

        $this->impersonateUserId = $user->id;
        $this->impersonateUserName = $user->name;
        $this->impersonateUserEmail = $user->email;
        $this->impersonateUserRole = $user->getRoleNames()->first() ?? 'Staff';
        $this->showFormModal = false;
        $this->showViewModal = false;
        $this->showImpersonateModal = true;
    }

    public function closeImpersonationModal(): void
    {
        $this->showImpersonateModal = false;
        $this->reset([
            'impersonateUserId',
            'impersonateUserName',
            'impersonateUserEmail',
            'impersonateUserRole',
        ]);
    }

    public function editUser(int $id): void
    {
        abort_unless(auth()->user()->can('edit users'), 403);

        $user = $this->findManageableUser($id);
        $this->resetForm();
        $this->fillFromUser($user);
        $this->showFormModal = true;
    }

    public function save(): void
    {
        $editing = $this->userId !== null;
        abort_unless(auth()->user()->can($editing ? 'edit users' : 'create users'), 403);

        $allowedRoleNames = $this->assignableRoles()->pluck('name')->all();
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->userId)],
            'selectedRole' => ['required', Rule::in($allowedRoleNames)],
            'password' => $editing
                ? ['nullable', 'confirmed', PasswordRule::defaults()]
                : ['required', 'confirmed', PasswordRule::defaults()],
        ];
        if (! $editing) {
            $rules['emailVerified'] = ['boolean'];
        }
        $this->validate($rules);

        if ($editing) {
            $user = $this->findManageableUser($this->userId);
            $currentRole = $user->getRoleNames()->first();

            if ($user->is(auth()->user()) && $currentRole !== $this->selectedRole) {
                $this->addError('selectedRole', 'You cannot change your own role.');

                return;
            }
            if ($currentRole === 'super-admin' && $this->selectedRole !== 'super-admin' && $this->superAdminCount() <= 1) {
                $this->addError('selectedRole', 'The final super-admin cannot be demoted.');

                return;
            }

            $emailChanged = strcasecmp($user->email, $this->email) !== 0;
            $user->name = $this->name;
            $user->email = $this->email;
            if ($emailChanged) {
                $user->email_verified_at = null;
            }
            if ($this->password !== '') {
                $user->password = $this->password;
            }
            $user->save();
            $user->syncRoles([$this->selectedRole]);
            $message = 'User updated successfully.';
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
            ]);
            $user->email_verified_at = auth()->user()->can(AdminPermissions::USER_VERIFY) && $this->emailVerified
                ? now()
                : null;
            $user->save();
            $user->assignRole($this->selectedRole);
            app(ManagedEmailSender::class)->send($user->email, EmailTemplateKey::UserAccountCreated, [
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
                'role' => ucfirst($this->selectedRole),
                'action_url' => route('login'),
            ]);
            $message = 'User account created successfully.';
        }

        $this->showFormModal = false;
        $this->resetForm();
        $this->dispatch('notify', message: $message, type: 'success');
    }

    public function verifyUser(int $id): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::USER_VERIFY), 403);

        $user = $this->findManageableUser($id);
        if ($user->email_verified_at) {
            $this->dispatch('notify', message: "{$user->name} is already verified.", type: 'info');

            return;
        }

        $user->forceFill(['email_verified_at' => now()])->save();
        event(new Verified($user));
        $this->dispatch('notify', message: "{$user->name} is now verified.", type: 'success');
    }

    public function resetTwoFactor(int $id): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::USER_RESET_TWO_FACTOR), 403);

        $user = $this->findManageableUser($id);
        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        app(ManagedEmailSender::class)->send($user->email, EmailTemplateKey::TwoFactorReset, [
            'recipient_name' => $user->name,
            'recipient_email' => $user->email,
            'occurred_at' => now()->format('F j, Y \a\t g:i A T'),
            'action_url' => route('security.edit'),
        ]);

        $this->dispatch('notify', message: "Two-factor authentication reset for {$user->name}.", type: 'success');
    }

    public function sendPasswordReset(int $id): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::USER_SEND_PASSWORD_RESET), 403);

        $user = $this->findManageableUser($id);
        if (! app(EmailTemplateRenderer::class)->isActive(EmailTemplateKey::PasswordResetAdmin)) {
            $this->dispatch('notify', message: 'The admin password-reset email template is paused.', type: 'error');

            return;
        }
        $token = Password::broker()->createToken($user);
        PasswordResetTemplateContext::use($token, EmailTemplateKey::PasswordResetAdmin);
        $user->notify(new ResetPassword($token));

        $this->dispatch('notify', message: "Password reset link sent to {$user->email}.", type: 'success');
    }

    public function selectVisible(array $ids): void
    {
        $validIds = $this->visibleQuery()->whereIn('id', $ids)->pluck('id')->map(fn ($id) => (string) $id)->all();
        $this->selectedUsers = array_values(array_unique([...$this->selectedUsers, ...$validIds]));
    }

    public function clearSelection(): void
    {
        $this->selectedUsers = [];
    }

    public function bulkVerify(): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::USER_VERIFY), 403);

        $ids = $this->manageableQuery()
            ->whereIn('id', $this->selectedUsers)
            ->whereNull('email_verified_at')
            ->pluck('id');
        $users = User::whereIn('id', $ids)->get();
        foreach ($users as $user) {
            $user->forceFill(['email_verified_at' => now()])->save();
            event(new Verified($user));
        }

        $count = $ids->count();
        $this->selectedUsers = [];
        $this->dispatch('notify', message: "{$count} users verified.", type: 'success');
    }

    public function confirmDelete(int $id): void
    {
        abort_unless(auth()->user()->can('delete users'), 403);

        $user = $this->findManageableUser($id);
        abort_if($user->is(auth()->user()), 422, 'You cannot delete your own account.');
        abort_if($user->hasRole('super-admin') && $this->superAdminCount() <= 1, 422, 'The final super-admin cannot be deleted.');

        $this->dispatch(
            'confirm-action',
            title: 'Delete User',
            message: "Delete {$user->name}? Their login access and security credentials will be removed.",
            action: 'delete-user-account',
            params: [$user->id],
        );
    }

    #[On('delete-user-account')]
    public function deleteUser(int $id): void
    {
        abort_unless(auth()->user()->can('delete users'), 403);

        $user = $this->findManageableUser($id);
        abort_if($user->is(auth()->user()), 422);
        abort_if($user->hasRole('super-admin') && $this->superAdminCount() <= 1, 422);
        $name = $user->name;
        app(ManagedEmailSender::class)->send($user->email, EmailTemplateKey::AccountDeleted, [
            'recipient_name' => $user->name,
            'recipient_email' => $user->email,
            'occurred_at' => now()->format('F j, Y \a\t g:i A T'),
            'action_url' => route('contact'),
        ]);
        $user->delete();

        $this->dispatch('notify', message: "{$name} was deleted.", type: 'success');
    }

    public function closeModals(): void
    {
        $this->showFormModal = false;
        $this->showViewModal = false;
        $this->closeImpersonationModal();
        $this->resetForm();
    }

    public function render()
    {
        abort_unless(auth()->user()->can('view users'), 403);

        $this->perPage = in_array($this->perPage, [10, 15, 25, 50], true) ? $this->perPage : 15;
        $this->sortField = in_array($this->sortField, ['name', 'email', 'email_verified_at', 'created_at'], true)
            ? $this->sortField
            : 'created_at';
        $this->sortDirection = in_array($this->sortDirection, ['asc', 'desc'], true) ? $this->sortDirection : 'desc';

        $users = $this->filteredQuery()
            ->with('roles.permissions')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $base = $this->visibleQuery();

        return view('livewire.admin.user-manager', [
            'users' => $users,
            'roles' => $this->assignableRoles(),
            'filterRoles' => Role::query()
                ->when(! auth()->user()->hasRole('super-admin'), fn (Builder $query) => $query->whereNotIn('name', ['admin', 'super-admin']))
                ->orderBy('name')
                ->get(),
            'totalUsers' => (clone $base)->count(),
            'verifiedUsers' => (clone $base)->whereNotNull('email_verified_at')->count(),
            'twoFactorUsers' => (clone $base)->whereNotNull('two_factor_confirmed_at')->count(),
            'newUsers' => (clone $base)->where('created_at', '>=', now()->startOfMonth())->count(),
        ])->layout('layouts.admin');
    }

    private function filteredQuery(): Builder
    {
        return $this->visibleQuery()
            ->when($this->search, function (Builder $query) {
                $query->where(function (Builder $searchQuery) {
                    $searchQuery->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->roleFilter !== 'all', fn (Builder $query) => $query->role($this->roleFilter))
            ->when($this->verificationFilter === 'verified', fn (Builder $query) => $query->whereNotNull('email_verified_at'))
            ->when($this->verificationFilter === 'unverified', fn (Builder $query) => $query->whereNull('email_verified_at'))
            ->when($this->verificationFilter === '2fa', fn (Builder $query) => $query->whereNotNull('two_factor_confirmed_at'));
    }

    private function visibleQuery(): Builder
    {
        return User::query()
            ->when(
                ! auth()->user()->hasRole('super-admin'),
                fn (Builder $query) => $query->whereDoesntHave('roles', fn (Builder $roleQuery) => $roleQuery->whereIn('name', ['admin', 'super-admin'])),
            );
    }

    private function manageableQuery(): Builder
    {
        return $this->visibleQuery()->whereKeyNot(auth()->id());
    }

    private function findVisibleUser(int $id): User
    {
        return $this->visibleQuery()->with('roles')->findOrFail($id);
    }

    private function findManageableUser(int $id): User
    {
        return $this->manageableQuery()->with('roles')->findOrFail($id);
    }

    private function assignableRoles()
    {
        return Role::query()
            ->when(
                ! auth()->user()->hasRole('super-admin'),
                fn ($query) => $query->whereNotIn('name', ['admin', 'super-admin']),
            )
            ->orderBy('name')
            ->get();
    }

    private function fillFromUser(User $user): void
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRole = $user->getRoleNames()->first() ?? 'viewer';
        $this->emailVerified = $user->email_verified_at !== null;
        $this->twoFactorEnabled = $user->two_factor_confirmed_at !== null;
        $this->canViewDashboard = $user->can('view dashboard');
        $this->createdAt = $user->created_at?->toIso8601String() ?? '';
    }

    private function resetForm(): void
    {
        $this->reset([
            'userId',
            'name',
            'email',
            'password',
            'password_confirmation',
            'selectedRole',
            'emailVerified',
            'twoFactorEnabled',
            'canViewDashboard',
            'createdAt',
        ]);
        $this->resetValidation();
    }

    private function superAdminCount(): int
    {
        return User::role('super-admin')->count();
    }
}
