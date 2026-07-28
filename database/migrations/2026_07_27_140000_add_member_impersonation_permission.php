<?php

use App\Support\SensitivePermissions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        DB::table('permissions')->insertOrIgnore([
            'name' => SensitivePermissions::MEMBER_IMPERSONATE,
            'guard_name' => 'web',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $sensitivePermissionIds = DB::table('permissions')
            ->whereIn('name', SensitivePermissions::NAMES)
            ->pluck('id');
        $superAdminRoleId = DB::table('roles')
            ->where('name', 'super-admin')
            ->where('guard_name', 'web')
            ->value('id');

        if ($sensitivePermissionIds->isNotEmpty()) {
            $query = DB::table('role_has_permissions')
                ->whereIn('permission_id', $sensitivePermissionIds);

            if ($superAdminRoleId) {
                $query->where('role_id', '!=', $superAdminRoleId);
            }

            $query->delete();

            DB::table('model_has_permissions')
                ->whereIn('permission_id', $sensitivePermissionIds)
                ->delete();
        }

        if ($superAdminRoleId) {
            $impersonatePermissionId = DB::table('permissions')
                ->where('name', SensitivePermissions::MEMBER_IMPERSONATE)
                ->where('guard_name', 'web')
                ->value('id');

            DB::table('role_has_permissions')->insertOrIgnore([
                'permission_id' => $impersonatePermissionId,
                'role_id' => $superAdminRoleId,
            ]);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        $permissionId = DB::table('permissions')
            ->where('name', SensitivePermissions::MEMBER_IMPERSONATE)
            ->where('guard_name', 'web')
            ->value('id');

        if (! $permissionId) {
            return;
        }

        DB::table('role_has_permissions')->where('permission_id', $permissionId)->delete();
        DB::table('model_has_permissions')->where('permission_id', $permissionId)->delete();
        DB::table('permissions')->where('id', $permissionId)->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};
