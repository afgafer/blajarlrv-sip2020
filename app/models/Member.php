<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable=['name','file','email','user_id'];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
