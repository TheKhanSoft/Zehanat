<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    private const PERMISSIONS = [
        'view settings',
        'edit settings',
        'edit email settings',
        'edit theme settings',
        'view homepage',
        'edit homepage',
        'view hero slides',
        'create hero slides',
        'edit hero slides',
        'delete hero slides',
        'view testimonials',
        'create testimonials',
        'edit testimonials',
        'delete testimonials'
    ];

    public function up(): void
    {
        DB::transaction(function (): void {
            $now = now();

            foreach (self::PERMISSIONS as $permission) {
                DB::table('permissions')->insertOrIgnore([
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $permissionIds = DB::table('permissions')
                ->where('guard_name', 'web')
                ->whereIn('name', self::PERMISSIONS)
                ->pluck('id', 'name');

            $superAdminId = DB::table('roles')->where('name', 'super-admin')->value('id');
            $adminId = DB::table('roles')->where('name', 'admin')->value('id');

            if ($superAdminId) {
                foreach (self::PERMISSIONS as $permission) {
                    DB::table('role_has_permissions')->insertOrIgnore([
                        'permission_id' => $permissionIds[$permission],
                        'role_id' => $superAdminId,
                    ]);
                }
            }

            if ($adminId) {
                $adminPermissions = [
                    'view settings',
                    'edit theme settings',
                    'view homepage',
                    'edit homepage',
                    'view hero slides',
                    'create hero slides',
                    'edit hero slides',
                    'view testimonials',
                    'create testimonials',
                    'edit testimonials'
                ];

                foreach ($adminPermissions as $permission) {
                    DB::table('role_has_permissions')->insertOrIgnore([
                        'permission_id' => $permissionIds[$permission],
                        'role_id' => $adminId,
                    ]);
                }
            }
        });

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        // Not implemented to prevent data loss
    }
};
