<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

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
                'email' => 'User1@merchant.com',
                'email_verified_at' => now(),
                'password' => 'password'
            ],
            [
                'name' => 'User2',
                'email' => 'User2@merchant.com',
                'email_verified_at' => now(),
                'password' => 'password'
            ]
        ];

        foreach ($users as $user) {
            $data = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'email_verified_at' => $user['email_verified_at'],
                'password' => bcrypt($user['password']),
            ]);

            $data->assignRole('merchant');
        }
    }
}
