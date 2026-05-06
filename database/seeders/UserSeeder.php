<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Playora',
            'email' => 'admin@playora.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'no_hp' => '081234567890',
        ]);
    }
}