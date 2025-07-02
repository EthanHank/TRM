<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
