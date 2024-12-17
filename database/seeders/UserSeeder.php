<?php

namespace Database\Seeders;

use App\Models\User;
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
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => NOW(),
            'password' => Hash::make("Admin12345678"),
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'email_verified_at' => NOW(),
            'password' => Hash::make("Guest12345678"),
        ]);
        $user->assignRole('user');
    }
}
