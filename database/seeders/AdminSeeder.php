<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
                'name' => 'Superadmin',
                'email' => 'superadmin@admin.com',
                'email_verified_at' => now(),
                'password' => 'password'
                ]
            ];
        
        $role = Role::where('name', 'superadmin')->first();

        foreach ($users as $user) {
            $data = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'email_verified_at' => $user['email_verified_at'],
                'password' => bcrypt($user['password']),
            ]);

            $data->assignRole($role);
        }
        
    }
}
