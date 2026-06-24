<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles untuk staff
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'kasir']);
        Role::firstOrCreate(['name' => 'owner']);

        // Role untuk pelanggan
        Role::firstOrCreate(['name' => 'pelanggan']);
    }
}
