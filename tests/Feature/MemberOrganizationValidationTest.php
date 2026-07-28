<?php

namespace Tests\Feature;

use App\Livewire\Admin\MemberManager;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MemberOrganizationValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_cannot_remove_organization_from_a_non_individual_member(): void
    {
        $role = Role::firstOrCreate(['name' => 'member-editor', 'guard_name' => 'web']);
        foreach (['view members', 'edit members'] as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        $role->syncPermissions(['view members', 'edit members']);
        $admin = User::factory()->create();
        $admin->assignRole($role);

        $member = Member::create([
            'name' => 'Student Member',
            'email' => 'student-member@example.com',
            'category' => 'student',
            'institution' => 'Zehanat University',
            'status' => 'pending',
        ]);

        Livewire::actingAs($admin)
            ->test(MemberManager::class)
            ->call('editMember', $member->id)
            ->set('institution', '')
            ->call('save')
            ->assertHasErrors(['institution' => 'required']);

        $this->assertSame('Zehanat University', $member->fresh()->institution);
    }
}
