<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "first_name",
        "last_name",
        "username",
        "email",
        "user_password",
        "otp",
        "is_verified",
        "mobile_no",
        "user_status",
        "role_id",
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
            'user_password' => 'hashed',
            //"user_password"=>"",
        ];
    }

    // User belong to Many Roles
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }


    public function hasRole($role) {
        return $this->roles()->where('name', $role)->exists();
    }


}
