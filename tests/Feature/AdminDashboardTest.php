<?php

namespace Tests\Feature;

use App\Livewire\Admin\DashboardManager;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Member;
use App\Models\NewsEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_authorized_user_can_view_dashboard_analytics_and_change_period(): void
    {
        $user = User::factory()->create();
        foreach (['view dashboard', 'view members', 'view contacts', 'view news'] as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        $user->givePermissionTo(['view dashboard', 'view members', 'view contacts', 'view news']);

        Member::create([
            'name' => 'Test Member',
            'email' => 'member@example.com',
            'category' => 'individual',
            'status' => 'approved',
        ]);

        ContactMessage::create([
            'name' => 'Test Contact',
            'email' => 'contact@example.com',
            'subject' => 'General inquiry',
            'message' => 'A test dashboard message.',
            'is_read' => false,
        ]);

        NewsEvent::create([
            'title' => 'Dashboard Update',
            'body' => 'Test content.',
            'type' => 'news',
            'is_published' => true,
        ]);

        Livewire::actingAs($user)
            ->test(DashboardManager::class)
            ->assertSet('range', 30)
            ->assertSee('Welcome back')
            ->assertSeeHtml('Growth & engagement')
            ->assertSee('Test Member')
            ->call('setRange', 7)
            ->assertSet('range', 7)
            ->assertSee('7 days');
    }

    public function test_dashboard_rejects_an_unsupported_reporting_period(): void
    {
        $user = User::factory()->create();
        Permission::firstOrCreate(['name' => 'view dashboard', 'guard_name' => 'web']);
        $user->givePermissionTo('view dashboard');

        Livewire::actingAs($user)
            ->test(DashboardManager::class)
            ->call('setRange', 365)
            ->assertSet('range', 30);
    }

    public function test_dashboard_hides_unauthorized_module_cards_and_activity(): void
    {
        $role = Role::create(['name' => 'news-analyst', 'guard_name' => 'web']);
        $role->givePermissionTo(['view dashboard', 'view news']);
        $user = User::factory()->create();
        $user->assignRole($role);

        Member::create([
            'name' => 'Confidential Member',
            'email' => 'confidential-member@example.com',
            'category' => 'individual',
            'status' => 'pending',
        ]);
        ContactMessage::create([
            'name' => 'Confidential Contact',
            'email' => 'confidential-contact@example.com',
            'subject' => 'Private inquiry',
            'message' => 'This must not appear.',
            'is_read' => false,
        ]);
        NewsEvent::create([
            'title' => 'Visible Editorial Update',
            'body' => 'Visible content.',
            'type' => 'news',
            'is_published' => true,
        ]);

        Livewire::actingAs($user)
            ->test(DashboardManager::class)
            ->assertSee('Published Content')
            ->assertSee('Visible Editorial Update')
            ->assertSee('Content readiness')
            ->assertSee('Upcoming events')
            ->assertDontSee('Total Members')
            ->assertDontSee('Pending Approvals')
            ->assertDontSee('Unread Messages')
            ->assertDontSee('Growth & engagement')
            ->assertDontSee('Membership composition')
            ->assertDontSee('Active FAQs')
            ->assertDontSee('Confidential Member')
            ->assertDontSee('Confidential Contact');
    }

    public function test_default_editor_sees_only_assigned_dashboard_modules(): void
    {
        Faq::create([
            'question' => 'How does permission-aware reporting work?',
            'answer' => 'Only assigned modules are rendered.',
            'is_active' => true,
        ]);
        $editor = User::where('email', 'editor@zehanat.org')->firstOrFail();

        Livewire::actingAs($editor)
            ->test(DashboardManager::class)
            ->assertSee('Published Content')
            ->assertSee('Active FAQs')
            ->assertSee('Create content')
            ->assertSee('Add an FAQ')
            ->assertDontSee('Total Members')
            ->assertDontSee('Unread Messages')
            ->assertDontSee('Growth & engagement')
            ->assertDontSee('Membership composition');
    }

    public function test_dashboard_only_user_sees_a_limited_access_state(): void
    {
        $role = Role::create(['name' => 'dashboard-only', 'guard_name' => 'web']);
        $role->givePermissionTo('view dashboard');
        $user = User::factory()->create();
        $user->assignRole($role);

        Livewire::actingAs($user)
            ->test(DashboardManager::class)
            ->assertSee('No operational modules assigned')
            ->assertDontSee('Total Members')
            ->assertDontSee('Unread Messages')
            ->assertDontSee('Published Content')
            ->assertDontSee('Active FAQs')
            ->assertDontSee('7 days');
    }
}
