<?php

namespace Tests\Feature;

use App\Livewire\Admin\UserManager;
use App\Models\User;
use App\Support\AdminPermissions;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_standard_users_but_cannot_see_privileged_accounts(): void
    {
        $admin = $this->createUserWithRole('admin', $this->userPermissions());
        $superAdmin = $this->createUserWithRole('super-admin', $this->userPermissions());
        $editorRole = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);
        $viewer = User::factory()->unverified()->create([
            'name' => 'Visible Viewer',
            'email' => 'viewer@example.com',
        ]);
        $viewer->assignRole($viewerRole);

        Livewire::actingAs($admin)
            ->test(UserManager::class)
            ->assertSee('Visible Viewer')
            ->assertDontSee($admin->email)
            ->assertDontSee($superAdmin->email)
            ->call('create')
            ->set('name', 'New Editor')
            ->set('email', 'editor@example.com')
            ->set('password', 'SecurePass123!')
            ->set('password_confirmation', 'SecurePass123!')
            ->set('selectedRole', $editorRole->name)
            ->set('emailVerified', true)
            ->call('save')
            ->assertHasNoErrors()
            ->call('verifyUser', $viewer->id);

        $created = User::where('email', 'editor@example.com')->firstOrFail();
        $this->assertTrue($created->hasRole('editor'));
        $this->assertNotNull($created->email_verified_at);
        $this->assertNotNull($viewer->fresh()->email_verified_at);

        $this->expectException(ModelNotFoundException::class);

        Livewire::actingAs($admin)
            ->test(UserManager::class)
            ->call('editUser', $superAdmin->id);
    }

    public function test_super_admin_can_manage_privileged_accounts_and_account_security(): void
    {
        Notification::fake();

        $superAdmin = $this->createUserWithRole('super-admin', $this->userPermissions());
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $operatorRole = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $operator = User::factory()->withTwoFactor()->create([
            'name' => 'Security Operator',
            'email' => 'security@example.com',
        ]);
        $operator->assignRole($operatorRole);

        Livewire::actingAs($superAdmin)
            ->test(UserManager::class)
            ->call('editUser', $operator->id)
            ->set('name', 'Senior Security Operator')
            ->set('selectedRole', 'admin')
            ->call('save')
            ->assertHasNoErrors()
            ->call('resetTwoFactor', $operator->id)
            ->call('sendPasswordReset', $operator->id);

        $operator->refresh();
        $this->assertSame('Senior Security Operator', $operator->name);
        $this->assertTrue($operator->hasRole('admin'));
        $this->assertNull($operator->two_factor_secret);
        $this->assertNull($operator->two_factor_recovery_codes);
        $this->assertNull($operator->two_factor_confirmed_at);
        Notification::assertSentTo($operator, ResetPassword::class);
    }

    public function test_user_management_supports_bulk_verification_and_protected_deletion(): void
    {
        $superAdmin = $this->createUserWithRole('super-admin', $this->userPermissions());
        $viewerRole = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);
        $first = User::factory()->unverified()->create();
        $second = User::factory()->unverified()->create();
        $first->assignRole($viewerRole);
        $second->assignRole($viewerRole);

        Livewire::actingAs($superAdmin)
            ->test(UserManager::class)
            ->set('selectedUsers', [(string) $first->id, (string) $second->id])
            ->call('bulkVerify')
            ->assertSet('selectedUsers', [])
            ->call('confirmDelete', $first->id)
            ->assertDispatched('confirm-action', action: 'delete-user-account')
            ->call('deleteUser', $first->id);

        $this->assertSoftDeletedOrMissing($first);
        $this->assertNotNull($second->fresh()->email_verified_at);
        $this->assertDatabaseHas('users', ['id' => $superAdmin->id]);
    }

    public function test_verified_user_cannot_be_manually_downgraded_to_unverified(): void
    {
        $superAdmin = $this->createUserWithRole('super-admin', $this->userPermissions());
        $viewerRole = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);
        $verifiedAt = now()->subDay()->startOfSecond();
        $viewer = User::factory()->create(['email_verified_at' => $verifiedAt]);
        $viewer->assignRole($viewerRole);

        Livewire::actingAs($superAdmin)
            ->test(UserManager::class)
            ->assertDontSee('Mark unverified')
            ->call('verifyUser', $viewer->id)
            ->call('editUser', $viewer->id)
            ->set('emailVerified', false)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertTrue($viewer->fresh()->email_verified_at->equalTo($verifiedAt));
    }

    public function test_changing_email_address_requires_verification_again(): void
    {
        $superAdmin = $this->createUserWithRole('super-admin', $this->userPermissions());
        $viewerRole = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);
        $viewer = User::factory()->create();
        $viewer->assignRole($viewerRole);

        Livewire::actingAs($superAdmin)
            ->test(UserManager::class)
            ->call('editUser', $viewer->id)
            ->set('email', 'new-address@example.com')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertNull($viewer->fresh()->email_verified_at);
    }

    public function test_user_without_view_permission_cannot_open_user_management(): void
    {
        $admin = $this->createUserWithRole('admin', []);

        Livewire::actingAs($admin)
            ->test(UserManager::class)
            ->assertForbidden();
    }

    private function createUserWithRole(string $roleName, array $permissions): User
    {
        $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $role->syncPermissions($permissions);
        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }

    private function userPermissions(): array
    {
        return [
            'view users',
            'create users',
            'edit users',
            'delete users',
            AdminPermissions::USER_VERIFY,
            AdminPermissions::USER_SEND_PASSWORD_RESET,
            AdminPermissions::USER_RESET_TWO_FACTOR,
        ];
    }

    private function assertSoftDeletedOrMissing(User $user): void
    {
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
