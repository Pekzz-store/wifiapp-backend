<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@wifiapp.test',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // TEKNISI
        User::create([
            'username' => 'teknisi',
            'name' => 'Teknisi Lapangan',
            'email' => 'teknisi@wifiapp.test',
            'password' => Hash::make('teknisi123'),
            'role' => 'teknisi',
        ]);
    }
}
