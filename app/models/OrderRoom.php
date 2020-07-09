<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OrderRoom extends Model
{
    protected $table='order_room';
    public $timestamps = false;
    
    public function getOrder(){
        return $this->belongsTo('App\models\Order','orders_id');
    }
    public function getRoom(){
        return $this->belongsTo('App\models\Room','rooms_id');
    }
}
