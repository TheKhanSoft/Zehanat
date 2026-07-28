<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_staff_roles_can_enter_the_admin_dashboard(): void
    {
        foreach (['editor', 'viewer', 'writer'] as $role) {
            $user = User::where('email', "{$role}@zehanat.org")->firstOrFail();

            $this->actingAs($user)
                ->get(route('admin.dashboard'))
                ->assertOk()
                ->assertSee('Welcome back');
        }
    }

    public function test_staff_pages_remain_restricted_by_page_permissions(): void
    {
        $editor = User::where('email', 'editor@zehanat.org')->firstOrFail();
        $viewer = User::where('email', 'viewer@zehanat.org')->firstOrFail();
        $writer = User::where('email', 'writer@zehanat.org')->firstOrFail();

        $this->actingAs($editor)->get(route('admin.news.index'))->assertOk();
        $this->actingAs($editor)->get(route('admin.members.index'))->assertForbidden();

        $this->actingAs($viewer)->get(route('admin.members.index'))->assertOk();
        $this->actingAs($viewer)->get(route('admin.contacts.index'))->assertOk();

        $this->actingAs($writer)->get(route('admin.news.index'))->assertOk();
        $this->actingAs($writer)->get(route('admin.contacts.index'))->assertForbidden();
    }

    public function test_custom_staff_role_can_use_routes_allowed_by_its_permissions(): void
    {
        $role = Role::create(['name' => 'content-reviewer', 'guard_name' => 'web']);
        $role->givePermissionTo(['view dashboard', 'view news']);
        $user = User::factory()->create();
        $user->assignRole($role);

        $this->actingAs($user)->get(route('admin.dashboard'))->assertOk();
        $this->actingAs($user)->get(route('admin.news.index'))->assertOk();
        $this->actingAs($user)->get(route('admin.members.index'))->assertForbidden();
    }

    public function test_user_without_a_staff_role_cannot_enter_admin_routes(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }
}
