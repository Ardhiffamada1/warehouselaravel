<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // TAMBAHKAN INI UNTUK ROLE (1:Staff, 2:Supervisor, 3:Admin)
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================================================================
    // FITUR TAMBAHAN UNTUK SISTEM MONITORING PRODUKSI PT. AMN
    // =========================================================================

    /**
     * Relasi ke data Absensi
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Logika Cek Absensi Hari Ini (Agar tombol absen di dashboard presisi)
     */
    public function hasAttendedToday(): bool
    {
        return $this->attendances()
                    ->whereDate('tanggal', now()->toDateString())
                    ->exists();
    }

    /**
     * Helper untuk cek role di Blade (Opsional tapi sangat membantu)
     */
    public function isStaff(): bool { return $this->role === 1; }
    public function isSupervisor(): bool { return $this->role === 2; }
    public function isSuperadmin(): bool { return $this->role === 3; }
}