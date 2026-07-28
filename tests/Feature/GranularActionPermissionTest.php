<?php

namespace Tests\Feature;

use App\Livewire\Admin\MemberManager;
use App\Livewire\Admin\UserManager;
use App\Models\Member;
use App\Models\User;
use App\Support\AdminPermissions;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GranularActionPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_action_buttons_and_handlers_are_bound_to_granular_permissions(): void
    {
        $pending = Member::create([
            'name' => 'Pending Applicant',
            'email' => 'pending-granular@example.com',
            'category' => 'individual',
            'status' => 'pending',
        ]);
        $approved = Member::create([
            'name' => 'Approved Applicant',
            'email' => 'approved-granular@example.com',
            'category' => 'student',
            'status' => 'approved',
        ]);
        $viewer = $this->userWithPermissions('member-action-viewer', ['view members', 'edit members']);

        Livewire::actingAs($viewer)
            ->test(MemberManager::class)
            ->assertDontSeeHtml('title="Accept member"')
            ->assertDontSeeHtml('title="Reject member"')
            ->assertDontSeeHtml('title="Ban member"');

        Livewire::actingAs($viewer)
            ->test(MemberManager::class)
            ->call('updateStatus', $pending->id, 'approved')
            ->assertForbidden();

        Livewire::actingAs($viewer)
            ->test(MemberManager::class)
            ->call('confirmBan', $approved->id)
            ->assertForbidden();

        Livewire::actingAs($viewer)
            ->test(MemberManager::class)
            ->call('editMember', $pending->id)
            ->set('memberStatus', 'approved')
            ->call('save')
            ->assertForbidden();

        $approver = $this->userWithPermissions('member-approver', ['view members', AdminPermissions::MEMBER_APPROVE]);
        Livewire::actingAs($approver)
            ->test(MemberManager::class)
            ->assertSeeHtml('title="Accept member"')
            ->assertDontSeeHtml('title="Reject member"')
            ->call('updateStatus', $pending->id, 'approved');
        $this->assertSame('approved', $pending->fresh()->status);

        $rejecter = $this->userWithPermissions('member-rejecter', ['view members', AdminPermissions::MEMBER_REJECT]);
        Livewire::actingAs($rejecter)
            ->test(MemberManager::class)
            ->assertSeeHtml('title="Reject member"')
            ->assertDontSeeHtml('title="Ban member"')
            ->call('updateStatus', $pending->id, 'rejected');
        $this->assertSame('rejected', $pending->fresh()->status);

        $banner = $this->userWithPermissions('member-banner', ['view members', AdminPermissions::MEMBER_BAN]);
        Livewire::actingAs($banner)
            ->test(MemberManager::class)
            ->assertSeeHtml('title="Ban member"')
            ->call('confirmBan', $approved->id)
            ->set('banReason', 'Granular access policy test.')
            ->call('banMember')
            ->assertHasNoErrors();
        $this->assertTrue($approved->fresh()->isBanned());

        $unbanner = $this->userWithPermissions('member-unbanner', ['view members', AdminPermissions::MEMBER_UNBAN]);
        Livewire::actingAs($unbanner)
            ->test(MemberManager::class)
            ->assertSeeHtml('title="Unban member"')
            ->assertDontSeeHtml('title="Ban member"')
            ->call('unbanMember', $approved->id);
        $this->assertFalse($approved->fresh()->isBanned());
    }

    public function test_user_security_buttons_and_handlers_are_bound_to_granular_permissions(): void
    {
        Notification::fake();
        $viewerRole = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);
        $target = User::factory()->unverified()->withTwoFactor()->create([
            'name' => 'Security Target',
            'email' => 'security-target@example.com',
        ]);
        $target->assignRole($viewerRole);
        $viewer = $this->userWithPermissions('user-action-viewer', ['view users']);

        Livewire::actingAs($viewer)
            ->test(UserManager::class)
            ->assertDontSeeHtml('title="Verify email"')
            ->assertDontSeeHtml('title="Send password reset"')
            ->assertDontSeeHtml('title="Reset 2FA"');

        foreach (['verifyUser', 'sendPasswordReset', 'resetTwoFactor'] as $action) {
            Livewire::actingAs($viewer)
                ->test(UserManager::class)
                ->call($action, $target->id)
                ->assertForbidden();
        }

        $verifier = $this->userWithPermissions('user-verifier', ['view users', AdminPermissions::USER_VERIFY]);
        Livewire::actingAs($verifier)
            ->test(UserManager::class)
            ->assertSeeHtml('title="Verify email"')
            ->assertDontSeeHtml('title="Send password reset"')
            ->call('verifyUser', $target->id);
        $this->assertNotNull($target->fresh()->email_verified_at);

        $passwordOperator = $this->userWithPermissions('password-operator', ['view users', AdminPermissions::USER_SEND_PASSWORD_RESET]);
        Livewire::actingAs($passwordOperator)
            ->test(UserManager::class)
            ->assertSeeHtml('title="Send password reset"')
            ->assertDontSeeHtml('title="Reset 2FA"')
            ->call('sendPasswordReset', $target->id);
        Notification::assertSentTo($target, ResetPassword::class);

        $twoFactorOperator = $this->userWithPermissions('two-factor-operator', ['view users', AdminPermissions::USER_RESET_TWO_FACTOR]);
        Livewire::actingAs($twoFactorOperator)
            ->test(UserManager::class)
            ->assertSeeHtml('title="Reset 2FA"')
            ->assertDontSeeHtml('title="Send password reset"')
            ->call('resetTwoFactor', $target->id);
        $this->assertNull($target->fresh()->two_factor_confirmed_at);
    }

    public function test_create_user_cannot_mark_email_verified_without_verify_permission(): void
    {
        $creator = $this->userWithPermissions('restricted-user-creator', ['view users', 'create users']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);

        Livewire::actingAs($creator)
            ->test(UserManager::class)
            ->call('create')
            ->assertSee('Created as unverified')
            ->assertDontSee('Mark email verified')
            ->set('name', 'Created Unverified')
            ->set('email', 'created-unverified@example.com')
            ->set('password', 'SecurePass123!')
            ->set('password_confirmation', 'SecurePass123!')
            ->set('selectedRole', $viewerRole->name)
            ->set('emailVerified', true)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertNull(User::where('email', 'created-unverified@example.com')->firstOrFail()->email_verified_at);
    }

    private function userWithPermissions(string $roleName, array $permissions): User
    {
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        $role->syncPermissions($permissions);
        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }
}
