<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class AssignUserRoles extends Command
{
    protected $signature = 'users:assign-roles';
    protected $description = 'Assign admin and editor roles to specific users';

    public function handle()
    {
        $adminEmails = [
            'abdessamadbattal@gmail.com',
        ];

        foreach ($adminEmails as $email) {
            $user = User::where('email', $email)->first();

            if ($user) {
                // Ensure the admin role exists
                $adminRole = Role::firstOrCreate(['name' => 'admin']);

                // Assign the admin role to the user
                $user->assignRole($adminRole);

                $this->info("Roles assigned to {$email}");
            }
        }

        $this->info('All roles assigned successfully!');
    }
}
