<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add permissions directly via migration
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'create homepage sections', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'delete homepage sections', 'guard_name' => 'web']);

        $role = Role::where('name', 'super-admin')->first();
        if ($role) {
            $role->givePermissionTo(['create homepage sections', 'delete homepage sections', 'edit homepage']);
        }
        $admin = Role::where('name', 'admin')->first();
        if ($admin) {
            $admin->givePermissionTo(['create homepage sections', 'delete homepage sections', 'edit homepage']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $role = Role::where('name', 'Super Admin')->first();
        if ($role) {
            $role->revokePermissionTo(['create homepage sections', 'delete homepage sections']);
        }

        Permission::whereIn('name', ['create homepage sections', 'delete homepage sections'])->delete();
    }
};
