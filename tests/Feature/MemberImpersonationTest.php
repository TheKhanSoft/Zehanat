<?php

namespace Tests\Feature;

use App\Livewire\Admin\MemberManager;
use App\Livewire\Admin\PermissionManager;
use App\Livewire\Admin\RoleManager;
use App\Models\Member;
use App\Models\User;
use App\Support\AdminPermissions;
use App\Support\SensitivePermissions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MemberImpersonationTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_impersonate_an_approved_member_and_return(): void
    {
        $superAdmin = $this->createSuperAdmin([
            SensitivePermissions::MEMBER_IMPERSONATE,
        ]);
        $member = Member::create([
            'name' => 'Approved Member',
            'email' => 'approved@example.com',
            'category' => 'individual',
            'status' => 'approved',
        ]);

        $this->actingAs($superAdmin)
            ->post(route('admin.members.impersonate', $member))
            ->assertRedirect(route('member.portal'))
            ->assertSessionHas('member_impersonation.member_id', $member->id);

        $this->actingAs($superAdmin)
            ->get(route('member.portal'))
            ->assertOk()
            ->assertSee('Approved Member')
            ->assertSee('Member portal preview');

        $this->actingAs($superAdmin)
            ->post(route('member.impersonation.stop'))
            ->assertRedirect(route('admin.members.index'))
            ->assertSessionMissing('member_impersonation');
    }

    public function test_super_admin_sees_a_modern_confirmation_before_member_impersonation(): void
    {
        $superAdmin = $this->createSuperAdmin([
            'view members',
            SensitivePermissions::MEMBER_IMPERSONATE,
        ]);
        $member = Member::create([
            'name' => 'Ayesha Member',
            'email' => 'ayesha-member@example.com',
            'category' => 'institution',
            'institution' => 'Zehanat Academy',
            'status' => 'approved',
        ]);

        Livewire::actingAs($superAdmin)
            ->test(MemberManager::class)
            ->call('confirmImpersonation', $member->id)
            ->assertSet('showImpersonateModal', true)
            ->assertSet('impersonateMemberId', $member->id)
            ->assertSet('impersonateMemberName', $member->name)
            ->assertSet('impersonateMemberEmail', $member->email)
            ->assertSet('impersonateMemberCategory', 'institution')
            ->assertSee('Confirm member impersonation')
            ->assertSee('Secure member preview')
            ->assertSee('Member portal')
            ->assertSee('Zehanat Academy')
            ->assertSee(route('admin.members.impersonate', $member), false)
            ->call('closeImpersonationModal')
            ->assertSet('showImpersonateModal', false)
            ->assertSet('impersonateMemberId', null);
    }

    public function test_member_impersonation_confirmation_rejects_an_ineligible_member(): void
    {
        $superAdmin = $this->createSuperAdmin([
            'view members',
            SensitivePermissions::MEMBER_IMPERSONATE,
        ]);
        $member = Member::create([
            'name' => 'Pending Member',
            'email' => 'pending-confirmation@example.com',
            'category' => 'student',
            'status' => 'pending',
        ]);

        Livewire::actingAs($superAdmin)
            ->test(MemberManager::class)
            ->call('confirmImpersonation', $member->id)
            ->assertStatus(422)
            ->assertSet('showImpersonateModal', false)
            ->assertSet('impersonateMemberId', null);
    }

    public function test_non_super_admin_cannot_impersonate_even_with_direct_permission(): void
    {
        $permission = Permission::firstOrCreate([
            'name' => SensitivePermissions::MEMBER_IMPERSONATE,
            'guard_name' => 'web',
        ]);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Permission::firstOrCreate([
            'name' => 'view members',
            'guard_name' => 'web',
        ]);
        $adminRole->givePermissionTo('view members');
        $adminRole->givePermissionTo($permission);
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);
        $member = Member::create([
            'name' => 'Approved Member',
            'email' => 'approved@example.com',
            'category' => 'student',
            'status' => 'approved',
        ]);

        $this->actingAs($admin)
            ->post(route('admin.members.impersonate', $member))
            ->assertForbidden()
            ->assertSessionMissing('member_impersonation');

        Livewire::actingAs($admin)
            ->test(MemberManager::class)
            ->call('confirmImpersonation', $member->id)
            ->assertForbidden()
            ->assertSet('showImpersonateModal', false);
    }

    public function test_pending_member_cannot_be_impersonated(): void
    {
        $superAdmin = $this->createSuperAdmin([
            SensitivePermissions::MEMBER_IMPERSONATE,
        ]);
        $member = Member::create([
            'name' => 'Pending Member',
            'email' => 'pending@example.com',
            'category' => 'institution',
            'status' => 'pending',
        ]);

        $this->actingAs($superAdmin)
            ->post(route('admin.members.impersonate', $member))
            ->assertStatus(422)
            ->assertSessionMissing('member_impersonation');
    }

    public function test_banned_approved_member_cannot_be_impersonated(): void
    {
        $superAdmin = $this->createSuperAdmin([
            SensitivePermissions::MEMBER_IMPERSONATE,
        ]);
        $member = Member::create([
            'name' => 'Banned Member',
            'email' => 'banned@example.com',
            'category' => 'individual',
            'status' => 'approved',
            'banned_at' => now(),
            'ban_reason' => 'Repeated misuse of member access.',
        ]);

        $this->actingAs($superAdmin)
            ->post(route('admin.members.impersonate', $member))
            ->assertStatus(422)
            ->assertSessionMissing('member_impersonation');
    }

    public function test_sensitive_permissions_cannot_be_assigned_to_managed_roles(): void
    {
        $superAdmin = $this->createSuperAdmin([
            'view roles',
            'create roles',
            'edit roles',
            SensitivePermissions::MEMBER_IMPERSONATE,
        ]);
        Permission::firstOrCreate(['name' => 'view members', 'guard_name' => 'web']);

        Livewire::actingAs($superAdmin)
            ->test(RoleManager::class)
            ->call('create')
            ->set('name', 'community-manager')
            ->set('selectedPermissions', [
                'view members',
                SensitivePermissions::MEMBER_IMPERSONATE,
                SensitivePermissions::USER_IMPERSONATE,
                'view roles',
            ])
            ->call('save')
            ->assertHasNoErrors();

        $role = Role::findByName('community-manager');

        $this->assertTrue($role->hasPermissionTo('view members'));
        $this->assertFalse($role->hasPermissionTo(SensitivePermissions::MEMBER_IMPERSONATE));
        $this->assertFalse($role->hasPermissionTo(SensitivePermissions::USER_IMPERSONATE));
        $this->assertFalse($role->hasPermissionTo('view roles'));
    }

    public function test_permission_directory_is_super_admin_only(): void
    {
        Permission::firstOrCreate(['name' => 'view permissions', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo('view permissions');
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);

        Livewire::actingAs($admin)
            ->test(PermissionManager::class)
            ->assertForbidden();
    }

    public function test_member_directory_supports_filtering_selection_and_bulk_status_updates(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        foreach (['view members', 'edit members', AdminPermissions::MEMBER_APPROVE] as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        $adminRole->syncPermissions(['view members', 'edit members', AdminPermissions::MEMBER_APPROVE]);
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);

        $individual = Member::create([
            'name' => 'Individual Applicant',
            'email' => 'individual@example.com',
            'category' => 'individual',
            'status' => 'pending',
        ]);
        $student = Member::create([
            'name' => 'Student Applicant',
            'email' => 'student@example.com',
            'category' => 'student',
            'status' => 'pending',
        ]);

        Livewire::actingAs($admin)
            ->test(MemberManager::class)
            ->assertSee('Individual Applicant')
            ->assertSee('Student Applicant')
            ->set('categoryFilter', 'student')
            ->assertDontSee('Individual Applicant')
            ->assertSee('Student Applicant')
            ->call('selectVisible', [$individual->id, $student->id])
            ->call('bulkUpdateStatus', 'approved')
            ->assertSet('selectedMembers', []);

        $this->assertDatabaseHas('members', ['id' => $individual->id, 'status' => 'approved']);
        $this->assertDatabaseHas('members', ['id' => $student->id, 'status' => 'approved']);
    }

    public function test_member_directory_can_ban_and_unban_an_approved_member(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        foreach (['view members', 'edit members', AdminPermissions::MEMBER_BAN, AdminPermissions::MEMBER_UNBAN] as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        $adminRole->syncPermissions(['view members', 'edit members', AdminPermissions::MEMBER_BAN, AdminPermissions::MEMBER_UNBAN]);
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);
        $member = Member::create([
            'name' => 'Approved Member',
            'email' => 'member-ban@example.com',
            'category' => 'industry',
            'status' => 'approved',
        ]);

        Livewire::actingAs($admin)
            ->test(MemberManager::class)
            ->assertSee('Ban member')
            ->call('confirmBan', $member->id)
            ->assertDispatched('open-modal', id: 'banMemberModal')
            ->set('banReason', 'Membership conduct policy violation.')
            ->call('banMember')
            ->assertHasNoErrors()
            ->assertDispatched('close-modal', id: 'banMemberModal')
            ->set('status', 'banned')
            ->assertSee('Banned')
            ->call('unbanMember', $member->id);

        $this->assertDatabaseHas('members', [
            'id' => $member->id,
            'status' => 'approved',
            'banned_at' => null,
            'ban_reason' => null,
        ]);
    }

    public function test_member_listing_exposes_accept_and_reject_actions(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        foreach (['view members', 'edit members', AdminPermissions::MEMBER_APPROVE, AdminPermissions::MEMBER_REJECT] as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        $adminRole->syncPermissions(['view members', 'edit members', AdminPermissions::MEMBER_APPROVE, AdminPermissions::MEMBER_REJECT]);
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);
        $member = Member::create([
            'name' => 'Pending Decision',
            'email' => 'pending-decision@example.com',
            'category' => 'student',
            'status' => 'pending',
        ]);

        Livewire::actingAs($admin)
            ->test(MemberManager::class)
            ->assertSee('Accept')
            ->assertSee('Reject')
            ->call('updateStatus', $member->id, 'approved');

        $this->assertDatabaseHas('members', [
            'id' => $member->id,
            'status' => 'approved',
        ]);
    }

    public function test_member_view_and_edit_modals_expose_enhanced_profile_controls(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        foreach (['view members', 'edit members'] as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        $adminRole->syncPermissions(['view members', 'edit members']);
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);
        $member = Member::create([
            'name' => 'Profile Member',
            'email' => 'profile-member@example.com',
            'phone' => '03001234567',
            'category' => 'industry',
            'institution' => 'Zehanat Labs',
            'message' => 'Interested in an industry partnership.',
            'status' => 'approved',
        ]);

        Livewire::actingAs($admin)
            ->test(MemberManager::class)
            ->call('viewMember', $member->id)
            ->assertDispatched('open-modal', id: 'viewMemberModal')
            ->assertSet('createdAt', $member->created_at->toIso8601String())
            ->assertSee('Membership overview')
            ->assertSee('Contact information')
            ->assertSee('Application message')
            ->assertSee('Zehanat Labs')
            ->call('editMember', $member->id)
            ->assertDispatched('open-modal', id: 'memberModal')
            ->assertSee('Identity and contact')
            ->assertSee('Membership category')
            ->assertSee('Application decision')
            ->assertSeeHtml('pattern="\+?[0-9]{7,15}"')
            ->set('phone', '+92 (300) 123-4567')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('close-modal', id: 'memberModal');

        $this->assertDatabaseHas('members', [
            'id' => $member->id,
            'phone' => '+923001234567',
        ]);
    }

    private function createSuperAdmin(array $permissions): User
    {
        $role = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $role->syncPermissions($permissions);
        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }
}
