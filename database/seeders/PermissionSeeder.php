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
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
