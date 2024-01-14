<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SuperAdmin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'profile_img_path',
        'password',
    ];

    protected $hidden = [
        'password',
        'rememberToken',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
}
