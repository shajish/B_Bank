<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

public function donationHistories()
    {
        return $this->hasOne('App\Models\DonationHistories', 'id', 'id');
    }
     public function events()
    {
        return $this->hasMany('App\Models\Events', 'user_id', 'id');
    }
    
    public function notifications()
    {
        return $this->hasMany('App\Models\Notifications', 'user_id', 'id');
    }
    public function roleUsers()
    {
        return $this->hasMany('App\Models\RoleUsers', 'user_id', 'id');
    }

    public function userProfiles()
    {
        return $this->hasMany('App\Models\UserProfiles', 'user_id', 'id');
    }
}
