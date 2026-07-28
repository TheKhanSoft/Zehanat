<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ResetSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates or resets the super admin account (super-admin@thekhansoft.com) and password.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = 'super-admin@thekhansoft.com';
        
        $this->info("Setting up Super Admin account: {$email}");
        
        $password = $this->secret('Please enter a new secure password for the super admin');
        
        if (strlen($password) < 8) {
            $this->error('Password must be at least 8 characters long.');
            return Command::FAILURE;
        }

        $confirmPassword = $this->secret('Please confirm the password');

        if ($password !== $confirmPassword) {
            $this->error('Passwords do not match.');
            return Command::FAILURE;
        }

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Super Admin',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );

        if (! $user->wasRecentlyCreated) {
            $user->update([
                'password' => Hash::make($password),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
            $this->info('Existing user updated.');
        } else {
            $this->info('New super admin user created.');
        }

        // Ensure role exists
        $role = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        
        // Assign role
        $user->assignRole($role);
        
        // Reset permission cache
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->info('Successfully assigned super-admin role and reset permission cache.');
        $this->info('You can now log in at /login with the email: ' . $email);
        
        return Command::SUCCESS;
    }
}
