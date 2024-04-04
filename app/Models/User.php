<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "username",
        "email",
        "user_password",
        "otp",
        "is_verified",
        "mobile_no",
        "user_status",
        "role_id",
        "first_name",
        "last_name",
        "occupation",
        "education",
        "country",
        "city",
        "area",
        "sex",
        "dob",
        "revenue",
        "total_credits",

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_password',
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

    // User belong to Many Roles
    public function roles() {
        return $this->belongsToMany(Role::class);
    }


    public function hasRole($role) {
        return $this->roles()->where('name', $role)->exists();
    }
}
