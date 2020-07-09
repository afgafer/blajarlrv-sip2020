<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function getORoom(){
        return $this->hasMany('App\models\OrderRoom','order_id');
    }
    public function getMember(){
        return $this->belongsTo('App\models\Member','members_id');
    }
    public function getStatus($status){
        if ($status==0) {
            $text="pending";
        }else if($status==1) {
            $text="processing";
        }else if($status==2) {
            $text="cancel";
        }else if($status==3) {
            $text="complete";
        }else if($status==4) {
            $text="denied";
        }
        return $text;
    }
    public function getBStatus(){
        $status=$this->status;
        if ($status==0) {
            $badge="<span class='badge badge-warning text-white'>pending</span>";
        }else if($status==1) {
            $badge="<span class='badge badge-primary'>processing</span>";
        }else if($status==2) {
            $badge="<span class='badge badge-danger'>cancel</span>";
        }else if($status==3) {
            $badge="<span class='badge badge-success'>complete</span>";
        }else if($status==4) {
            $badge="<span class='badge badge-danger'>reject</span>";
        }
        return $badge;
    }
    public function getCout(){
        $date=date_create($this->cout);
        return date_format($date,'d-m-Y');
    }
    public function getCin(){
        $date=date_create($this->cin);
        return date_format($date,'d-m-Y');
    }
    public function getBill(){
        return 'Rp '.number_format($this->bill,0,'','.');
    }
}
