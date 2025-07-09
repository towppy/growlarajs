<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    //MARAMIHAN na fill sa tables :P

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'is_admin',       // optional legacy use
        'role',           // required for role editing
        'is_active',      // required for enable/disable toggle

        'is_admin',
        // 'role', // Remove if not used in your DB

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',

        'is_active' => 'boolean', // ✅ Add this
    ];

    

    public function getJWTIdentifier()
    {
        return $this->getKey(); 
    }



    public function getJWTCustomClaims()
    {
        return [];
    }
}
