<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable=['name','file','email','hotel_id','dest_id','user_id'];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function hotel(){
        return $this->belongsTo('App\models\Hotel','hotel_id');
    }
    public function dest(){
        return $this->belongsTo('App\models\Dest','dest_id');
    }
}
