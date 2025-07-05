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
        'role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
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
