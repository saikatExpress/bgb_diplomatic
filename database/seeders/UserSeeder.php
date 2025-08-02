<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'       => 'User One',
                'email'      => 'user1@gmail.com',
                'mobile'     => '1111111111',
                'password'   => Hash::make('123456'),
                'role'       => 'user',
                'status'     => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'name'       => 'User Two',
                'email'      => 'user2@gmail.com',
                'mobile'     => '2222222222',
                'password'   => Hash::make('123456'),
                'role'       => 'admin',
                'status'     => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'name'       => 'User Three',
                'email'      => 'user3@gmail.com',
                'mobile'     => '3333333333',
                'password'   => Hash::make('123456'),
                'role'       => 'user',
                'status'     => 'inactive',
                'created_at' => Carbon::now()
            ],
            [
                'name'       => 'Admin',
                'email'      => 'admin@gmail.com',
                'mobile'     => '4444444444',
                'password'   => Hash::make('123456'),
                'role'       => 'admin',
                'status'     => 'active',
                'created_at' => Carbon::now()
            ],
            [
                'name'       => 'Super Admin',
                'email'      => 'super_admin@gmail.com',
                'mobile'     => '01712634946',
                'password'   => Hash::make('123456'),
                'role'       => 'super-admin',
                'status'     => 'active',
                'created_at' => Carbon::now()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
