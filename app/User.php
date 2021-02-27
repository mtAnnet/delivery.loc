<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function promocode(){
        return $this->hasOne(Promocode::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function isNotAdmin()
    {
        return $this->role->name !== 'admin';
    }

    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }
    public function isUser()
    {
        return $this->role->name === 'registered';
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
