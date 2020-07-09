<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public $timestamps = false;
    public function room(){
        return $this->hasMany('App\models\Room','hotel_id');
    }
}
