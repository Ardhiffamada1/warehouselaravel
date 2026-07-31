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
            'name' => 'Superadmin PT AMN',
            'email' => 'admin@andalan.com',
            'password' => Hash::make('password123'),
            'role' => 3, 
        ]);

        User::create([
            'name' => 'Supervisor Produksi',
            'email' => 'spv@andalan.com',
            'password' => Hash::make('password123'),
            'role' => 2,
        ]);
        User::create([
            'name' => 'Staf Gudang',
            'email' => 'staff@andalan.com',
            'password' => Hash::make('password123'),
            'role' => 1,
        ]);
    }
}