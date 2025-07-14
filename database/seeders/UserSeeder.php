<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'User1',
                'full_name' => 'User1',
                'nrc' => '12/KK/745443',
                'phone' => '8435984753',
                'address' => 'Yangon, Myanmar',
                'gender' => 'male',
                'date_of_birth' => '2000-01-01',
                'email' => 'User1@merchant.com',
                'email_verified_at' => now(),
                'password' => 'password',
                'is_opened' => true,
                'status' => true,
            ],
            [
                'name' => 'User2',
                'full_name' => 'User2',
                'nrc' => '12/KK/384758',
                'phone' => '38798475235',
                'address' => 'Yangon, Myanmar',
                'gender' => 'male',
                'date_of_birth' => '2000-01-01',
                'email' => 'User2@merchant.com',
                'email_verified_at' => now(),
                'password' => 'password',
                'is_opened' => true,
                'status' => true,
            ],
        ];

        $role = Role::where('name', 'merchant')->first();

        $permissions = Permission::where('name', 'user-dashboard')->get();
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
                'status' => $user['status'],
            ]);

            $data->assignRole('merchant');
            
        }
    }
}
