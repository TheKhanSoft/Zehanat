<?php

namespace Tests\Feature;

use App\Livewire\Admin\MemberManager;
use App\Livewire\Admin\PermissionManager;
use App\Livewire\Admin\UserManager;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminUiLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_directory_uses_a_responsive_four_to_six_column_card_grid(): void
    {
        $superAdmin = User::where('email', 'super-admin@zehanat.org')->firstOrFail();

        Livewire::actingAs($superAdmin)
            ->test(PermissionManager::class)
            ->assertSee('Permission catalog')
            ->assertSee('Assigned roles')
            ->assertSeeHtml('data-permission-grid')
            ->assertSeeHtml('xl:grid-cols-4')
            ->assertSeeHtml('2xl:grid-cols-6');
    }

    public function test_member_and_user_modals_use_balanced_width_and_non_overlapping_content(): void
    {
        $superAdmin = User::where('email', 'super-admin@zehanat.org')->firstOrFail();
        $member = Member::create([
            'name' => 'Modal Layout Member',
            'email' => 'modal-layout@example.com',
            'category' => 'individual',
            'status' => 'approved',
        ]);

        Livewire::actingAs($superAdmin)
            ->test(MemberManager::class)
            ->call('viewMember', $member->id)
            ->assertDispatched('open-modal', id: 'viewMemberModal')
            ->assertSee('Member profile')
            ->assertSeeHtml('mt-1 overflow-hidden rounded-2xl')
            ->assertSeeHtml('overflow-x-hidden overflow-y-auto')
            ->assertDontSeeHtml('-mt-5')
            ->assertDontSeeHtml('w-screen overflow-y-auto');

        Livewire::actingAs($superAdmin)
            ->test(UserManager::class)
            ->call('create')
            ->assertSet('showFormModal', true)
            ->assertSeeHtml('overflow-x-hidden overflow-y-auto')
            ->assertDontSeeHtml('w-screen overflow-y-auto');
    }
}
