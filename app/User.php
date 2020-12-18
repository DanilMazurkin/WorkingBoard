<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function checkUserInSystem($id) {
        $user = User::find($id);
        
        if (empty($user))
            return 0;
        else 
            return 1;
    }

    public function checkUserFromGoogle($id) {
        $user = User::find($id);

        if (!empty($user->google_id))
            return true;
        else
            return false;
    }

    public function userdata() {
        return $this->hasOne(UserData::class);
    }

    public function ads()
    {
      return $this->hasMany(Ad::class);
    }
    
}
