<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Chukwu Okonkwo',
            'email' => 'chukwu@pems.com',
            'password' => Hash::make('password'),
            'phone' => '+234 803 123 4567',
            'role' => 'BD_USER',
            'status' => 'ACTIVE',
        ]);

        User::create([
            'name' => 'Zainab Muhammadu',
            'email' => 'zainab@pems.com',
            'password' => Hash::make('password'),
            'phone' => '+234 805 234 5678',
            'role' => 'OPS_MANAGER',
            'status' => 'ACTIVE',
        ]);

        User::create([
            'name' => 'Adebayo Johnson',
            'email' => 'adebayo@pems.com',
            'password' => Hash::make('password'),
            'phone' => '+234 806 345 6789',
            'role' => 'BD_USER',
            'status' => 'ON_LEAVE',
        ]);
    }
}