<?php

namespace Tests\Feature;

use App\Livewire\Admin\UserManager;
use App\Models\User;
use App\Support\SensitivePermissions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserImpersonationTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_login_as_a_user_and_return_safely(): void
    {
        $superAdmin = $this->createUserWithRole('super-admin', [
            'view users',
            SensitivePermissions::USER_IMPERSONATE,
        ]);
        $viewer = $this->createUserWithRole('viewer', ['view dashboard']);

        $this->actingAs($superAdmin)
            ->post(route('admin.users.impersonate', $viewer))
            ->assertRedirect(route('admin.dashboard'))
            ->assertSessionHas('user_impersonation.impersonator_id', $superAdmin->id)
            ->assertSessionHas('user_impersonation.target_id', $viewer->id);

        $this->assertAuthenticatedAs($viewer);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Return to super-admin');

        $this->post(route('user.impersonation.stop'))
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionMissing('user_impersonation');

        $this->assertAuthenticatedAs($superAdmin);
    }

    public function test_login_as_button_is_visible_only_to_super_admin(): void
    {
        $superAdmin = $this->createUserWithRole('super-admin', [
            'view users',
            SensitivePermissions::USER_IMPERSONATE,
        ]);
        $admin = $this->createUserWithRole('admin', ['view users', 'view dashboard']);
        $viewer = $this->createUserWithRole('viewer', ['view dashboard']);

        Livewire::actingAs($superAdmin)
            ->test(UserManager::class)
            ->assertSee('Login as')
            ->assertSee($admin->email)
            ->assertDontSeeHtml('window.confirm')
            ->call('confirmImpersonation', $viewer->id)
            ->assertSet('showImpersonateModal', true)
            ->assertSet('impersonateUserId', $viewer->id)
            ->assertSet('impersonateUserName', $viewer->name)
            ->assertSee('Confirm user impersonation')
            ->assertSee('Secure session switch')
            ->assertSee('Admin dashboard')
            ->assertSee('Continue as')
            ->call('closeImpersonationModal')
            ->assertSet('showImpersonateModal', false)
            ->assertSet('impersonateUserId', null);

        Livewire::actingAs($admin)
            ->test(UserManager::class)
            ->assertDontSee('Login as')
            ->assertDontSee($superAdmin->email)
            ->assertDontSee($admin->email)
            ->assertSee($viewer->email);
    }

    public function test_admin_cannot_impersonate_even_with_direct_permission(): void
    {
        $admin = $this->createUserWithRole('admin', [
            'view users',
            SensitivePermissions::USER_IMPERSONATE,
        ]);
        $viewer = $this->createUserWithRole('viewer', ['view dashboard']);

        $this->actingAs($admin)
            ->post(route('admin.users.impersonate', $viewer))
            ->assertForbidden()
            ->assertSessionMissing('user_impersonation');

        $this->assertAuthenticatedAs($admin);

        Livewire::actingAs($admin)
            ->test(UserManager::class)
            ->call('confirmImpersonation', $viewer->id)
            ->assertForbidden();
    }

    public function test_super_admin_cannot_impersonate_another_super_admin(): void
    {
        $permission = SensitivePermissions::USER_IMPERSONATE;
        $first = $this->createUserWithRole('super-admin', [$permission]);
        $second = User::factory()->create();
        $second->assignRole('super-admin');

        $this->actingAs($first)
            ->post(route('admin.users.impersonate', $second))
            ->assertStatus(422)
            ->assertSessionMissing('user_impersonation');
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
}
