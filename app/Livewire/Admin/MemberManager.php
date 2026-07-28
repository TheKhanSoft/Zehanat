<?php

namespace App\Livewire\Admin;

use App\Enums\EmailTemplateKey;
use App\Models\Member;
use App\Services\ManagedEmailSender;
use App\Services\MemberCsvImporter;
use App\Support\AdminPermissions;
use App\Support\SensitivePermissions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class MemberManager extends Component
{
    use WithFileUploads, WithPagination;

    public function mount()
    {
        abort_if(! auth()->user()->can('view members'), 403);
    }

    public $search = '';

    public $status = 'all';

    public $categoryFilter = 'all';

    public $sortField = 'created_at';

    public $sortDirection = 'desc';

    public int $perPage = 15;

    public array $selectedMembers = [];

    public $memberId = null;

    public $name = '';

    public $email = '';

    public $phone = '';

    public $category = '';

    public $institution = '';

    public $message = '';

    public $memberStatus = 'pending';

    public ?string $bannedAt = null;

    public string $banReason = '';

    public string $createdAt = '';

    public string $updatedAt = '';

    public bool $showImpersonateModal = false;

    public ?int $impersonateMemberId = null;

    public string $impersonateMemberName = '';

    public string $impersonateMemberEmail = '';

    public string $impersonateMemberCategory = '';

    public string $impersonateMemberInstitution = '';

    public ?TemporaryUploadedFile $importFile = null;

    public bool $showImportModal = false;

    /** @var array{imported: int, skipped: int, total: int}|null */
    public ?array $importSummary = null;

    /** @var array<int, array{row: int, messages: array<int, string>}> */
    public array $importErrors = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
        'categoryFilter' => ['except' => 'all', 'as' => 'category'],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 15],
    ];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('members', 'email')->ignore($this->memberId)],
            'phone' => ['nullable', 'string', 'regex:/^\+?[0-9]{7,15}$/'],
            'category' => ['required', Rule::in(['individual', 'institution', 'industry', 'student'])],
            'institution' => [
                Rule::requiredIf(fn (): bool => in_array($this->category, ['institution', 'industry', 'student'], true)),
                'nullable',
                'string',
                'max:255',
            ],
            'message' => 'nullable|string|max:2000',
            'memberStatus' => 'required|in:pending,approved,rejected',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->selectedMembers = [];
    }

    public function updatingStatus()
    {
        $this->resetPage();
        $this->selectedMembers = [];
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
        $this->selectedMembers = [];
    }

    public function updatedPerPage($value): void
    {
        $this->perPage = in_array((int) $value, [10, 15, 25, 50], true) ? (int) $value : 15;
        $this->resetPage();
        $this->selectedMembers = [];
    }

    public function sortBy(string $field): void
    {
        abort_unless(in_array($field, ['name', 'category', 'status', 'created_at'], true), 400);

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function selectVisible(array $ids): void
    {
        $validIds = Member::whereIn('id', $ids)->pluck('id')->map(fn ($id) => (string) $id)->all();
        $this->selectedMembers = array_values(array_unique([...$this->selectedMembers, ...$validIds]));
    }

    public function clearSelection(): void
    {
        $this->selectedMembers = [];
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'status', 'categoryFilter']);
        $this->selectedMembers = [];
        $this->resetPage();
    }

    public function bulkUpdateStatus(string $newStatus): void
    {
        abort_unless(in_array($newStatus, ['pending', 'approved', 'rejected'], true), 422);
        $this->authorizeStatusChange($newStatus);

        $members = Member::whereIn('id', $this->selectedMembers)->get();
        $ids = $members->pluck('id');
        $changes = ['status' => $newStatus];
        if ($newStatus !== 'approved') {
            $changes['banned_at'] = null;
            $changes['ban_reason'] = null;
        }
        Member::whereIn('id', $ids)->update($changes);

        if (in_array($newStatus, ['approved', 'rejected'], true)) {
            foreach ($members as $member) {
                if ($member->status !== $newStatus) {
                    $this->sendMemberStatusEmail($member, $newStatus);
                }
            }
        }

        $count = $ids->count();
        $this->selectedMembers = [];
        $this->dispatch('notify', message: "{$count} members updated to {$newStatus}.", type: 'success');
    }

    public function viewMember($id)
    {
        $member = Member::findOrFail($id);

        $this->fillFromMember($member);

        $this->dispatch('open-modal', id: 'viewMemberModal');
    }

    public function editMember($id)
    {
        abort_if(! auth()->user()->can('edit members'), 403);

        $member = Member::findOrFail($id);

        $this->fillFromMember($member);

        $this->dispatch('open-modal', id: 'memberModal');
    }

    public function confirmImpersonation(int $id): void
    {
        $operator = auth()->user();

        abort_unless(
            $operator->hasRole('super-admin')
                && $operator->can(SensitivePermissions::MEMBER_IMPERSONATE),
            403,
        );

        $member = Member::findOrFail($id);
        abort_unless(
            $member->status === 'approved' && ! $member->isBanned(),
            422,
            'Only active approved members can be impersonated.',
        );

        $this->impersonateMemberId = $member->id;
        $this->impersonateMemberName = $member->name;
        $this->impersonateMemberEmail = $member->email;
        $this->impersonateMemberCategory = $member->category;
        $this->impersonateMemberInstitution = $member->institution ?: 'Independent member';
        $this->showImpersonateModal = true;
    }

    public function closeImpersonationModal(): void
    {
        $this->showImpersonateModal = false;
        $this->reset([
            'impersonateMemberId',
            'impersonateMemberName',
            'impersonateMemberEmail',
            'impersonateMemberCategory',
            'impersonateMemberInstitution',
        ]);
    }

    public function save()
    {
        abort_if(! auth()->user()->can('edit members'), 403);

        $this->email = strtolower(trim($this->email));

        if (is_string($this->phone)) {
            $phone = trim($this->phone);
            $this->phone = $phone === '' ? null : preg_replace('/[\s().-]+/', '', $phone);
        }
        $this->institution = is_string($this->institution) ? trim($this->institution) : null;

        $validated = $this->validate(messages: [
            'institution.required' => 'Institution or organization is required for institution, industry, and student members.',
        ]);
        unset($validated['memberStatus']);
        $validated['status'] = $this->memberStatus;

        if ($this->memberId) {
            $member = Member::findOrFail($this->memberId);
            $previousStatus = $member->status;
            if ($member->status !== $this->memberStatus) {
                $this->authorizeStatusChange($this->memberStatus);
            }
            if ($this->memberStatus !== 'approved') {
                $validated['banned_at'] = null;
                $validated['ban_reason'] = null;
            }
            $member->update($validated);
            if ($previousStatus !== $this->memberStatus && in_array($this->memberStatus, ['approved', 'rejected'], true)) {
                $this->sendMemberStatusEmail($member, $this->memberStatus);
            }
            $message = 'Member updated successfully.';
        }

        $this->dispatch('close-modal', id: 'memberModal');
        $this->dispatch('notify', message: $message, type: 'success');
        $this->resetFields();
    }

    public function updateStatus($id, $newStatus)
    {
        abort_unless(in_array($newStatus, ['pending', 'approved', 'rejected'], true), 422);
        $this->authorizeStatusChange($newStatus);

        $member = Member::findOrFail($id);
        $previousStatus = $member->status;
        $member->status = $newStatus;
        if ($newStatus !== 'approved') {
            $member->banned_at = null;
            $member->ban_reason = null;
        }
        $member->save();
        if ($previousStatus !== $newStatus && in_array($newStatus, ['approved', 'rejected'], true)) {
            $this->sendMemberStatusEmail($member, $newStatus);
        }

        $action = $newStatus === 'approved' ? 'accepted' : ($newStatus === 'rejected' ? 'rejected' : 'moved to pending');
        $this->dispatch('notify', message: "Member {$action} successfully.", type: 'success');
    }

    public function confirmBan(int $id): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::MEMBER_BAN), 403);

        $member = Member::findOrFail($id);
        abort_unless($member->status === 'approved' && ! $member->isBanned(), 422);

        $this->memberId = $member->id;
        $this->name = $member->name;
        $this->banReason = '';
        $this->resetValidation('banReason');
        $this->dispatch('open-modal', id: 'banMemberModal');
    }

    public function banMember(): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::MEMBER_BAN), 403);

        $this->validate([
            'banReason' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        $member = Member::findOrFail($this->memberId);
        abort_unless($member->status === 'approved' && ! $member->isBanned(), 422);

        $member->update([
            'banned_at' => now(),
            'ban_reason' => $this->banReason,
        ]);

        app(ManagedEmailSender::class)->send($member->email, EmailTemplateKey::MembershipBanned, [
            'recipient_name' => $member->name,
            'recipient_email' => $member->email,
            'ban_reason' => $member->ban_reason,
            'action_url' => route('contact'),
        ]);

        $this->dispatch('close-modal', id: 'banMemberModal');
        $this->dispatch('notify', message: "{$member->name} has been banned.", type: 'success');
        $this->resetFields();
    }

    public function unbanMember(int $id): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::MEMBER_UNBAN), 403);

        $member = Member::findOrFail($id);
        abort_unless($member->isBanned(), 422);
        $member->update(['banned_at' => null, 'ban_reason' => null]);

        app(ManagedEmailSender::class)->send($member->email, EmailTemplateKey::MembershipUnbanned, [
            'recipient_name' => $member->name,
            'recipient_email' => $member->email,
            'action_url' => route('home'),
        ]);

        $this->dispatch('notify', message: "{$member->name} has been unbanned.", type: 'success');
    }

    public function resetFields()
    {
        $this->reset(['memberId', 'name', 'email', 'phone', 'category', 'institution', 'message', 'memberStatus', 'bannedAt', 'banReason', 'createdAt', 'updatedAt']);
    }

    public function openImportModal(): void
    {
        abort_unless(auth()->user()->can('import members'), 403);

        $this->resetImport();
        $this->showImportModal = true;
    }

    public function closeImportModal(): void
    {
        $this->showImportModal = false;
        $this->resetImport();
    }

    public function importMembers(): void
    {
        abort_unless(auth()->user()->can('import members'), 403);

        $this->validate([
            'importFile' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ], [
            'importFile.required' => 'Choose a CSV file to import.',
            'importFile.mimes' => 'The import must be a CSV file.',
            'importFile.max' => 'The CSV file may not be larger than 5 MB.',
        ]);

        $path = $this->importFile->getRealPath();
        if ($path === false) {
            $this->addError('importFile', 'The uploaded CSV file is no longer available. Choose it again.');

            return;
        }

        try {
            $result = app(MemberCsvImporter::class)->import($path);
        } catch (RuntimeException $exception) {
            $this->addError('importFile', $exception->getMessage());

            return;
        } catch (Throwable $exception) {
            report($exception);
            $this->addError('importFile', 'The CSV could not be imported. Verify the file and try again.');

            return;
        }

        $this->importSummary = [
            'imported' => $result['imported'],
            'skipped' => $result['skipped'],
            'total' => $result['total'],
        ];
        $this->importErrors = array_slice($result['errors'], 0, 100);
        $this->importFile = null;
        $this->resetPage();

        $type = $result['imported'] > 0 ? 'success' : 'warning';
        $this->dispatch(
            'notify',
            message: "{$result['imported']} members imported; {$result['skipped']} rows skipped.",
            type: $type,
        );
    }

    public function downloadImportTemplate(): StreamedResponse
    {
        abort_unless(auth()->user()->can('import members'), 403);

        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'wb');
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, ['Name', 'Email', 'Phone', 'Category', 'Institution', 'Status', 'Access', 'Ban Reason', 'Joined']);
            fclose($output);
        }, 'members-import-template.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function exportMembers(): StreamedResponse
    {
        abort_unless(auth()->user()->can('export members'), 403);

        $members = $this->filteredQuery()->orderBy($this->sortField, $this->sortDirection)->get();

        return response()->streamDownload(function () use ($members) {
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, ['Name', 'Email', 'Phone', 'Category', 'Institution', 'Status', 'Access', 'Ban Reason', 'Joined']);

            foreach ($members as $member) {
                fputcsv($output, [
                    $this->csvValue($member->name),
                    $this->csvValue($member->email),
                    $this->csvValue($member->phone),
                    $this->csvValue($member->category),
                    $this->csvValue($member->institution),
                    $this->csvValue($member->status),
                    $member->isBanned() ? 'Banned' : 'Active',
                    $this->csvValue($member->ban_reason),
                    $member->created_at->toDateString(),
                ]);
            }

            fclose($output);
        }, 'zehanat-members-'.now()->format('Y-m-d').'.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function confirmDelete($id)
    {
        abort_if(! auth()->user()->can('delete members'), 403);

        $this->dispatch('confirm-action',
            title: 'Delete Member',
            message: 'Are you sure you want to delete this member? This action cannot be undone.',
            action: 'delete-member',
            params: [$id]
        );
    }

    #[On('delete-member')]
    public function deleteMember($id)
    {
        abort_if(! auth()->user()->can('delete members'), 403);

        $member = Member::findOrFail($id);
        $member->delete();

        $this->dispatch('notify', message: 'Member deleted successfully.', type: 'success');
    }

    public function render()
    {
        $this->perPage = in_array($this->perPage, [10, 15, 25, 50], true) ? $this->perPage : 15;
        $this->status = in_array($this->status, ['all', 'pending', 'approved', 'rejected', 'banned'], true) ? $this->status : 'all';
        $this->categoryFilter = in_array($this->categoryFilter, ['all', 'individual', 'institution', 'industry', 'student'], true)
            ? $this->categoryFilter
            : 'all';

        if (! in_array($this->sortField, ['name', 'category', 'status', 'created_at'], true)) {
            $this->sortField = 'created_at';
        }
        if (! in_array($this->sortDirection, ['asc', 'desc'], true)) {
            $this->sortDirection = 'desc';
        }

        $members = $this->filteredQuery()
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $totalMembers = Member::count();
        $pendingMembers = Member::pending()->count();
        $approvedMembers = Member::approved()->whereNull('banned_at')->count();
        $rejectedMembers = Member::where('status', 'rejected')->count();
        $bannedMembers = Member::banned()->count();
        $newThisMonth = Member::where('created_at', '>=', now()->startOfMonth())->count();

        return view('livewire.admin.member-manager', [
            'members' => $members,
            'totalMembers' => $totalMembers,
            'pendingMembers' => $pendingMembers,
            'approvedMembers' => $approvedMembers,
            'rejectedMembers' => $rejectedMembers,
            'bannedMembers' => $bannedMembers,
            'newThisMonth' => $newThisMonth,
        ])->layout('layouts.admin');
    }

    private function filteredQuery(): Builder
    {
        return Member::query()
            ->when($this->search, function (Builder $query) {
                $query->where(function (Builder $searchQuery) {
                    $searchQuery->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('phone', 'like', '%'.$this->search.'%')
                        ->orWhere('institution', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->status === 'banned', fn (Builder $query) => $query->whereNotNull('banned_at'))
            ->when($this->status === 'approved', fn (Builder $query) => $query->where('status', 'approved')->whereNull('banned_at'))
            ->when(in_array($this->status, ['pending', 'rejected'], true), fn (Builder $query) => $query->where('status', $this->status))
            ->when($this->categoryFilter !== 'all', fn (Builder $query) => $query->where('category', $this->categoryFilter));
    }

    private function csvValue(?string $value): string
    {
        $value ??= '';

        return preg_match('/^[=+\-@]/', $value) ? "'".$value : $value;
    }

    private function fillFromMember(Member $member): void
    {
        $this->memberId = $member->id;
        $this->name = $member->name;
        $this->email = $member->email;
        $this->phone = $member->phone;
        $this->category = $member->category;
        $this->institution = $member->institution;
        $this->message = $member->message;
        $this->memberStatus = $member->status;
        $this->bannedAt = $member->banned_at?->toIso8601String();
        $this->banReason = $member->ban_reason ?? '';
        $this->createdAt = $member->created_at?->toIso8601String() ?? '';
        $this->updatedAt = $member->updated_at?->toIso8601String() ?? '';
    }

    private function resetImport(): void
    {
        $this->reset(['importFile', 'importSummary', 'importErrors']);
        $this->resetValidation('importFile');
    }

    private function authorizeStatusChange(string $status): void
    {
        $permission = match ($status) {
            'approved' => AdminPermissions::MEMBER_APPROVE,
            'rejected' => AdminPermissions::MEMBER_REJECT,
            default => 'edit members',
        };

        abort_unless(auth()->user()->can($permission), 403);
    }

    private function sendMemberStatusEmail(Member $member, string $status): void
    {
        $key = $status === 'approved'
            ? EmailTemplateKey::MembershipApproved
            : EmailTemplateKey::MembershipRejected;

        app(ManagedEmailSender::class)->send($member->email, $key, [
            'recipient_name' => $member->name,
            'recipient_email' => $member->email,
            'category' => ucfirst($member->category),
            'institution' => $member->institution ?: 'Not provided',
            'action_url' => $status === 'approved' ? route('home') : route('contact'),
        ]);
    }
}
