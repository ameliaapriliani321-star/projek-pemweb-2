<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles terlebih dahulu
        $this->call(RoleSeeder::class);

        // Buat akun admin default
        $admin = User::firstOrCreate(
            ['email' => 'admin@laundry.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        // Buat akun pelanggan contoh
        $pelanggan = User::firstOrCreate(
            ['email' => 'user@laundry.com'],
            [
                'name' => 'Pelanggan Demo',
                'password' => bcrypt('password'),
            ]
        );
        if (!$pelanggan->hasRole('pelanggan')) {
            $pelanggan->assignRole('pelanggan');
        }

        // Buat data pelanggan terhubung
        \App\Models\Pelanggan::firstOrCreate(
            ['user_id' => $pelanggan->id],
            [
                'nama_pelanggan' => 'Pelanggan Demo',
                'no_telepon' => '081234567890',
                'alamat' => 'Jl. Contoh No. 1, Kota',
            ]
        );
    }
}
