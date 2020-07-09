<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function admin(){
        return $this->belongsTo('App\models\Admin','admin_id');
    }
    public function getDate(){
        $time=date_create($this->date);
        $date=date_format($time,'d-m-Y');
        return $date;
    }
}
