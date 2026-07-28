<?php

namespace Tests\Feature;

use App\Models\User;
use App\Support\ErrorPageDestination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ErrorPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_common_error_pages_use_the_shared_modern_experience(): void
    {
        foreach ([400, 401, 403, 404, 405, 419, 422, 429, 500, 503] as $status) {
            $this->view("errors.{$status}")
                ->assertSee("HTTP {$status}")
                ->assertSee('Return to public home')
                ->assertSee('Go back');
        }
    }

    public function test_unknown_public_page_uses_the_custom_404_view(): void
    {
        config(['app.debug' => false]);

        $this->get('/a-page-that-does-not-exist')
            ->assertNotFound()
            ->assertSee('This page drifted off the map.')
            ->assertSee('Return to public home');
    }

    public function test_error_destination_follows_guest_user_admin_and_member_contexts(): void
    {
        $guest = Request::create('/missing');
        $this->assertSame('guest', ErrorPageDestination::resolve($guest)['context']);

        $user = User::factory()->create();
        $userRequest = Request::create('/missing');
        $userRequest->setUserResolver(fn () => $user);
        $this->assertSame('user', ErrorPageDestination::resolve($userRequest)['context']);

        Permission::firstOrCreate(['name' => 'view dashboard', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'error-page-admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo('view dashboard');
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);
        $adminRequest = Request::create('/missing');
        $adminRequest->setUserResolver(fn () => $admin);
        $this->assertSame('admin', ErrorPageDestination::resolve($adminRequest)['context']);

        $session = app('session')->driver();
        $session->start();
        $session->put('member_impersonation', [
            'admin_id' => $admin->id,
            'member_id' => 123,
        ]);
        $memberRequest = Request::create('/missing');
        $memberRequest->setUserResolver(fn () => $admin);
        $memberRequest->setLaravelSession($session);
        $destination = ErrorPageDestination::resolve($memberRequest);
        $this->assertSame('member', $destination['context']);
        $this->assertSame(route('member.portal'), $destination['url']);
    }

    public function test_rendered_error_pages_offer_the_correct_authenticated_destination(): void
    {
        config(['app.debug' => false]);

        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden()
            ->assertSee('This area is outside your access.')
            ->assertSee('Return to your dashboard');

        Permission::firstOrCreate(['name' => 'view dashboard', 'guard_name' => 'web']);
        $role = Role::firstOrCreate(['name' => 'rendered-error-admin', 'guard_name' => 'web']);
        $role->givePermissionTo('view dashboard');
        $admin = User::factory()->create();
        $admin->assignRole($role);

        $this->actingAs($admin)
            ->get('/another-page-that-does-not-exist')
            ->assertNotFound()
            ->assertSee('Return to admin dashboard');

        $this->withSession([
            'member_impersonation' => [
                'admin_id' => $admin->id,
                'member_id' => 456,
            ],
        ])->get('/member-page-that-does-not-exist')
            ->assertNotFound()
            ->assertSee('Return to member portal');
    }
}
