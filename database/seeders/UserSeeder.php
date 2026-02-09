<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin',
                'password' => Hash::make('1234'),
                'role' => 'admin'
            ]
        );

        User::firstOrCreate(
            ['username' => 'teknisi'],
            [
                'name' => 'Teknisi',
                'password' => Hash::make('1234'),
                'role' => 'teknisi'
            ]
        );
    }
}