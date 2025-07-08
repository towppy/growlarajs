<?php
<<<<<<< HEAD
=======

>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

<<<<<<< HEAD
=======
    //MARAMIHAN na fill sa tables :P
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
<<<<<<< HEAD
        'is_admin',       // optional legacy use
        'role',           // required for role editing
        'is_active',      // required for enable/disable toggle
=======
        'is_admin',
        // 'role', // Remove if not used in your DB
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
<<<<<<< HEAD
        'is_active' => 'boolean', // ✅ Add this
    ];

=======
    ];
   
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
    public function getJWTIdentifier()
    {
        return $this->getKey(); 
    }

<<<<<<< HEAD
=======
  
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
    public function getJWTCustomClaims()
    {
        return [];
    }
}
