<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke data pelanggan
     */
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'user_id');
    }

    /**
     * Cek apakah user adalah pelanggan
     */
    public function isPelanggan(): bool
    {
        return $this->hasRole('pelanggan');
    }

    /**
     * Cek apakah user adalah admin/kasir/owner
     */
    public function isAdmin(): bool
    {
        return $this->hasAnyRole(['admin', 'kasir', 'owner']);
    }

    /**
     * Tentukan apakah user bisa akses panel Filament (admin)
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(['admin', 'kasir', 'owner']);
    }
}
