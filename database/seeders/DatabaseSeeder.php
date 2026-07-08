<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Super Admin (Owner)
        User::create([
            'name' => 'Bos Mahayani',
            'no_hp' => '081111111111',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        // 2. Akun Admin (Karyawan)
        User::create([
            'name' => 'Budi Pegawai',
            'no_hp' => '082222222222',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 3. Akun Customer (Pembeli)
        User::create([
            'name' => 'Siti Pembeli',
            'no_hp' => '083333333333',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);
    }
}
