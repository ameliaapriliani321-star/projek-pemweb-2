<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminUser extends Command
{
    protected $signature = 'make:admin {--name= : Nama user} {--email= : Email user} {--password= : Password user}';

    protected $description = 'Buat user admin untuk panel Filament (otomatis assign role admin)';

    public function handle(): int
    {
        // Pastikan role admin ada
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $name = $this->option('name') ?? $this->ask('Nama');
        $email = $this->option('email') ?? $this->ask('Email');
        $password = $this->option('password') ?? $this->secret('Password');

        if (User::where('email', $email)->exists()) {
            $user = User::where('email', $email)->first();

            if (!$user->hasRole('admin')) {
                $user->assignRole('admin');
                $this->info("User '{$email}' sudah ada, role admin berhasil di-assign.");
            } else {
                $this->info("User '{$email}' sudah admin.");
            }

            return self::SUCCESS;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('admin');

        $this->info("Admin berhasil dibuat!");
        $this->table(['Nama', 'Email', 'Role'], [
            [$user->name, $user->email, 'admin'],
        ]);

        return self::SUCCESS;
    }
}
