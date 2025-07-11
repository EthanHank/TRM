<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'create-user',
                'category' => 'User Management',
                'guard_name' => 'web',

            ],
            [
                'name' => 'edit-user',
                'category' => 'User Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-user',
                'category' => 'User Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'view-user',
                'category' => 'User Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create-role',
                'category' => 'Role Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit-role',
                'category' => 'Role Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-role',
                'category' => 'Role Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'view-role',
                'category' => 'Role Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'view-permission',
                'category' => 'Permission Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create-appointment-type',
                'category' => 'Appointment Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit-appointment-type',
                'category' => 'Appointment Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-appointment-type',
                'category' => 'Appointment Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'view-appointment-type',
                'category' => 'Appointment Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create-result-type',
                'category' => 'Result Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit-result-type',
                'category' => 'Result Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-result-type',
                'category' => 'Result Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'view-result-type',
                'category' => 'Result Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create-paddy-type',
                'category' => 'Paddy Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit-paddy-type',
                'category' => 'Paddy Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-paddy-type',
                'category' => 'Paddy Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'view-paddy-type',
                'category' => 'Paddy Type Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'create-paddy',
                'category' => 'Paddy Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'edit-paddy',
                'category' => 'Paddy Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete-paddy',
                'category' => 'Paddy Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'view-paddy',
                'category' => 'Paddy Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user-dashboard',
                'category' => 'Portal Management',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin-dashboard',
                'category' => 'Portal Management',
                'guard_name' => 'web',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
