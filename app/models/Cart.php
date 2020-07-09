<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Cart 
{
    public $items=null;
    public $tQty=0;
    public $tPrice=0;

    public function __construct($oldC)
    {   
        if($oldC){
            $this->items=$oldC->items;
            $this->tQty=$oldC->tQty;
            $this->tPrice=$oldC->tPrice;
        }
    }

    public function add($item,$id,$duration)
    {   
        $sItem=['qty'=>0, 'cost'=>0, 'item'=>$item, 'duration'=>$duration];
        if ($this->items) {
            if (array_key_exists($id,$this->items)) {
                $sItem=$this->items[$id];
            }
        }
        if ($sItem['qty']<$item->quota) {
            $sItem['qty']++;
            $sItem['cost']+=$item->price * $duration;
            $this->items[$id]=$sItem;
            $this->tQty++;
            $this->tPrice+=$item->price * $duration;   
            return '1';
        }else{
            return "0";
        }
            
        //awal
        // if ($this->items) {
        //     if (!array_key_exists($id,$this->items)) {
        //         $sItem['qty']++;
        //         $sItem['cost']=$item->price * $duration;
        //         $this->items[$id]=$sItem;
        //         $this->tQty++;
        //         $this->tPrice+=$sItem['cost'];     
        //     }
        // }else{
        //     $sItem['qty']++;
        //     $sItem['cost']=$item->price * $duration;
        //     $this->items[$id]=$sItem;
        //     $this->tQty++;
        //     $this->tPrice+=$sItem['cost'];     
        // }
        //asli
        // if ($this->items) {
        //     if (array_key_exists($id,$this->items)) {
        //         $sItem=$this->items[$id];
        //     }
        // }
        //     $sItem['qty']++;
        //     $sItem['harga']=$item->harga * $sItem['qty'];
        //     $this->items[$id]=$sItem;
        //     $this->tQty++;
        //     $this->tPrice+=$item->harga;   
    }
    public function rOne($id,$duration){
        $this->items[$id]['qty']--;
        $this->items[$id]['cost']-=$this->items[$id]['item']->price * $duration;
        $this->tQty--;
        $this->tPrice-=$this->items[$id]['item']->price * $duration;
        if ($this->items[$id]['qty']<=0) {
            unset($this->items[$id]);
        }
    }
    public function rItem($id){
        $this->tQty-=$this->items[$id]['qty'];
        $this->tPrice-=$this->items[$id]['cost'];
        unset($this->items[$id]);
    }
}
