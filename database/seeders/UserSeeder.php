<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'       => 'User',
            'email'      => 'user@gmail.com',
            'mobile'     => '000000000',
            'password'   => Hash::make('123456'),
            'role'       => 'user',
            'status'     => 'active',
            'created_at' => Carbon::now()
        ]);
    }
}
