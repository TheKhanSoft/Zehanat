<?php

namespace Tests\Feature;

use App\Models\User;
use App\Support\SensitivePermissions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DefaultAccessControlDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_roles_permissions_and_users_are_inserted_by_migrations(): void
    {
        $this->assertSame(46, Permission::count());

        foreach ([
            'super-admin' => 46,
            'admin' => 36,
            'editor' => 7,
            'viewer' => 5,
            'writer' => 4,
        ] as $roleName => $permissionCount) {
            $role = Role::findByName($roleName);
            $this->assertCount($permissionCount, $role->permissions);
        }

        foreach ([
            'super-admin@zehanat.org' => 'super-admin',
            'admin@zehanat.org' => 'admin',
            'editor@zehanat.org' => 'editor',
            'viewer@zehanat.org' => 'viewer',
            'writer@zehanat.org' => 'writer',
        ] as $email => $role) {
            $user = User::where('email', $email)->firstOrFail();
            $this->assertTrue($user->hasRole($role));
            $this->assertNotNull($user->email_verified_at);
        }

        $this->assertTrue(Role::findByName('super-admin')->hasPermissionTo(SensitivePermissions::USER_IMPERSONATE));
        $this->assertFalse(Role::findByName('admin')->hasPermissionTo(SensitivePermissions::USER_IMPERSONATE));

        foreach ([
            'approve members',
            'reject members',
            'ban members',
            'unban members',
            'verify users',
            'send user password resets',
            'reset user two factor',
            'change user status',
        ] as $permission) {
            $this->assertTrue(Role::findByName('super-admin')->hasPermissionTo($permission));
            $this->assertTrue(Role::findByName('admin')->hasPermissionTo($permission));
            $this->assertFalse(SensitivePermissions::isSensitive($permission));
        }
    }

    public function test_rerunning_data_insertion_does_not_overwrite_existing_passwords(): void
    {
        $admin = User::where('email', 'admin@zehanat.org')->firstOrFail();
        $admin->forceFill(['password' => 'A-different-secure-password-123!'])->save();

        $migration = require database_path('migrations/2026_07_27_153000_insert_default_access_control_data.php');
        $migration->up();

        $this->assertTrue(Hash::check('A-different-secure-password-123!', $admin->fresh()->password));
        $this->assertSame(5, User::whereIn('email', [
            'super-admin@zehanat.org',
            'admin@zehanat.org',
            'editor@zehanat.org',
            'viewer@zehanat.org',
            'writer@zehanat.org',
        ])->count());
    }
}
