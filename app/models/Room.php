<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;
    public function hotel(){
        return $this->belongsTo('App\models\Hotel','hotel_id');
    }
}
