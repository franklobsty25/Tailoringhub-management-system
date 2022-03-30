<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'name',
        'email',
        'password',
        'subscription_reference',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Getting the user's role
    public function role() {
        return $this->hasOne(Role::class);
    }

    /**
     * User refer to tailor/seamstress sign up
     * This is to note a user/tailor has only one detail
     */
    public function profile() {
        return $this->hasOne(Detail::class);
    }

    // Support message
    public function support() {
        return $this->hasMany(Support::class);
    }

    /**
     * Checking user role if an administrator
     */
    public function hasAdminRole($admin) {
        if ($this->role->role === $admin) {
            return true;
        }
        return false;
    }

    public function customers() {
        return $this->hasMany(Customer::class);
    }

    public function getFullNameAttribute() {
        return "{$this->firstName} {$this->lastName}";
    }
}
