<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Define permissions
                $permissions = [
                    'view posts',
                    'create posts',
                    'edit posts',
                    'delete posts',
                    'publish posts',
                    'unpublish posts',
                ];

                // Create permissions
                foreach ($permissions as $permission) {
                    Permission::firstOrCreate(['name' => $permission]);
                }

                // Define roles
                $roles = [
                    'admin' => $permissions,
                    'editor' => ['view posts', 'create posts', 'edit posts', 'publish posts', 'unpublish posts'],
                    'writer' => ['view posts', 'create posts', 'edit posts'],
                    'user' => ['view posts'], // Default role for registered users
                    'guest' => ['view posts'],
                ];

                // Create roles and assign permissions
                foreach ($roles as $role => $rolePermissions) {
                    $role = Role::firstOrCreate(['name' => $role]);
                    $role->syncPermissions($rolePermissions);
                }
    }
}
