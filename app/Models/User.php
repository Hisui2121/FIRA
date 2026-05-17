<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [

        'first_name',
        'last_name',

        'email',
        'password',

        'birthdate',
        'sex',

        'phone_number',

        'city',
        'barangay',
        'street',
        'house_no',

        'profile_photo',
        'cover_photo',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'birthdate' => 'date',

            'password' => 'hashed',

        ];
    }

    /**
     * FULL NAME ACCESSOR
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * SETTINGS RELATIONSHIP
     */
    public function setting()
    {
        return $this->hasOne(Setting::class);
    }
}