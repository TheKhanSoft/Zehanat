<?php

use App\Models\User;
use App\Support\AdminPermissions;
use App\Support\SensitivePermissions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    private const ROLE_PERMISSIONS = [
        'editor' => [
            'view dashboard',
            'view news',
            'create news',
            'edit news',
            'view faqs',
            'create faqs',
            'edit faqs',
        ],
        'viewer' => [
            'view dashboard',
            'view news',
            'view faqs',
            'view contacts',
            'view members',
        ],
        'writer' => [
            'view dashboard',
            'view news',
            'create news',
            'edit news',
        ],
    ];

    private const DEFAULT_USERS = [
        'super-admin@zehanat.org' => ['name' => 'Super Admin', 'role' => 'super-admin'],
        'admin@zehanat.org' => ['name' => 'Admin', 'role' => 'admin'],
        'editor@zehanat.org' => ['name' => 'Editor', 'role' => 'editor'],
        'viewer@zehanat.org' => ['name' => 'Viewer', 'role' => 'viewer'],
        'writer@zehanat.org' => ['name' => 'Writer', 'role' => 'writer'],
    ];

    public function up(): void
    {
        DB::transaction(function (): void {
            $now = now();
            $permissions = $this->permissionNames();
            $roles = array_keys($this->rolePermissions($permissions));

            foreach ($permissions as $permission) {
                DB::table('permissions')->insertOrIgnore([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            foreach ($roles as $role) {
                DB::table('roles')->insertOrIgnore([
                    'name' => $role,
                    'guard_name' => 'web',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $roleIds = DB::table('roles')
                ->where('guard_name', 'web')
                ->whereIn('name', $roles)
                ->pluck('id', 'name');
            $permissionIds = DB::table('permissions')
                ->where('guard_name', 'web')
                ->whereIn('name', $permissions)
                ->pluck('id', 'name');

            foreach ($this->rolePermissions($permissions) as $role => $rolePermissions) {
                $roleId = $roleIds[$role];

                DB::table('role_has_permissions')->where('role_id', $roleId)->delete();

                foreach ($rolePermissions as $permission) {
                    DB::table('role_has_permissions')->insertOrIgnore([
                        'permission_id' => $permissionIds[$permission],
                        'role_id' => $roleId,
                    ]);
                }
            }

            $missingEmails = collect(array_keys(self::DEFAULT_USERS))
                ->diff(DB::table('users')->whereIn('email', array_keys(self::DEFAULT_USERS))->pluck('email'));

            if ($missingEmails->isNotEmpty()) {
                $password = $this->bootstrapPassword();

                foreach ($missingEmails as $email) {
                    DB::table('users')->insert([
                        'name' => self::DEFAULT_USERS[$email]['name'],
                        'email' => $email,
                        'email_verified_at' => $now,
                        'password' => Hash::make($password),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            $userIds = DB::table('users')
                ->whereIn('email', array_keys(self::DEFAULT_USERS))
                ->pluck('id', 'email');

            foreach (self::DEFAULT_USERS as $email => $definition) {
                $userId = $userIds[$email];

                DB::table('model_has_roles')
                    ->where('model_type', User::class)
                    ->where('model_id', $userId)
                    ->delete();

                DB::table('model_has_roles')->insertOrIgnore([
                    'role_id' => $roleIds[$definition['role']],
                    'model_type' => User::class,
                    'model_id' => $userId,
                ]);
            }
        });

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        // Intentionally non-destructive: rollbacks must not delete real users,
        // roles, or permissions that may already be in active use.
    }

    private function permissionNames(): array
    {
        $permissions = [];

        foreach (['dashboard', 'roles', 'permissions', 'faqs', 'news', 'members', 'contacts', 'users', 'email templates'] as $module) {
            foreach (['view', 'create', 'edit', 'delete'] as $action) {
                if ($module === 'dashboard' && $action !== 'view') {
                    continue;
                }

                $permissions[] = "{$action} {$module}";
            }
        }

        return [
            ...$permissions,
            'export members',
            'import members',
            ...AdminPermissions::GRANULAR_ACTIONS,
            AdminPermissions::EMAIL_TEMPLATE_SEND_TEST,
            SensitivePermissions::MEMBER_IMPERSONATE,
            SensitivePermissions::USER_IMPERSONATE,
        ];
    }

    private function rolePermissions(array $allPermissions): array
    {
        return [
            'super-admin' => $allPermissions,
            'admin' => array_values(array_filter(
                $allPermissions,
                fn (string $permission): bool => ! SensitivePermissions::isSensitive($permission),
            )),
            ...self::ROLE_PERMISSIONS,
        ];
    }

    private function bootstrapPassword(): string
    {
        $password = config('bootstrap-users.password');

        if (is_string($password) && $password !== '') {
            if (app()->environment('production') && strlen($password) < 12) {
                throw new RuntimeException('BOOTSTRAP_DEFAULT_USER_PASSWORD must contain at least 12 characters in production.');
            }

            return $password;
        }

        if (app()->environment('production')) {
            throw new RuntimeException('Set BOOTSTRAP_DEFAULT_USER_PASSWORD before running migrations in production.');
        }

        return 'password';
    }
};
