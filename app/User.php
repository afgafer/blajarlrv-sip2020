<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','contact','type'
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

    public function admin(){
        return $this->hasOne('App\models\Admin','user_id');
    }
    public function member(){
        return $this->hasOne('App\models\Member','user_id');
    }
    public function dest(){
        return $this->hasOne('App\models\Dest','admins','user_id','dest_id');
    }
    public function hotel(){
        return $this->hasOne('App\models\Hotel','admins','user_id','hotel_id');
    }
}
