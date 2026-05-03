<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 'client' or 'freelancer'
        'phone',
        'avatar',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relasi ke Client (jika role = client)
    public function client()
    {
        return $this->hasOne(Client::class, 'email', 'email');
    }

    // Relasi ke Freelancer (jika role = freelancer)
    public function freelancer()
    {
        return $this->hasOne(Freelancer::class, 'email', 'email');
    }
}
