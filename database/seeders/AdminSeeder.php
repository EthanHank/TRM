<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
                [
                'name' => 'Super Admin',
                'full_name' => 'Pyae Phyo Win',
                'nrc' => '12/KK/123456',
                'phone' => '0123456789',
                'address' => 'Yangon, Myanmar',
                'gender' => 'male',
                'date_of_birth' => '2000-01-01',
                'email' => 'superadmin@admin.com',
                'email_verified_at' => now(),
                'password' => 'password',
                'is_opened' => true,
                'status' => true
                ]
            ];
        
        $role = Role::where('name', 'superadmin')->first();

        // Assign all permissions to the role ONCE
        $permissions = Permission::where('guard_name', 'web')->get();
        $role->syncPermissions($permissions);

        foreach ($users as $user) {
            $data = User::create([
                'name' => $user['name'],
                'full_name' => $user['full_name'],
                'nrc' => $user['nrc'],
                'phone' => $user['phone'],
                'address' => $user['address'],
                'gender' => $user['gender'],
                'date_of_birth' => $user['date_of_birth'],
                'email' => $user['email'],
                'email_verified_at' => $user['email_verified_at'],
                'password' => bcrypt($user['password']),
                'is_opened' => $user['is_opened'],
                'status' => $user['status']
            ]);

            $data->assignRole($role->name);
            
        }
        
    }
}
