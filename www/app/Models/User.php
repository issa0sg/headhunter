<?php

namespace App\Models;

use Egulias\EmailValidator\Warning\Comment;
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

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }

    public function targeted()
    {
        return $this->hasMany(Order::class,'target_id');
    }

    public function hunter()
    {
        return $this->hasMany(Order::class,'hunter_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
