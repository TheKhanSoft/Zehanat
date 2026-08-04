<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create the permission
        $manageMedia = Permission::firstOrCreate(['name' => 'manage media', 'guard_name' => 'web']);

        // Assign to super-admin
        $superAdmin = Role::where('name', 'super-admin')->first();
        if ($superAdmin) {
            $superAdmin->givePermissionTo($manageMedia);
        }

        // Also assign to admin
        $admin = Role::where('name', 'admin')->first();
        if ($admin) {
            $admin->givePermissionTo($manageMedia);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $manageMedia = Permission::where('name', 'manage media')->first();
        
        if ($manageMedia) {
            $superAdmin = Role::where('name', 'super-admin')->first();
            if ($superAdmin) {
                $superAdmin->revokePermissionTo($manageMedia);
            }

            $admin = Role::where('name', 'admin')->first();
            if ($admin) {
                $admin->revokePermissionTo($manageMedia);
            }

            $manageMedia->delete();
        }
    }
};
