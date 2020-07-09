<?php

namespace App\Http\Controllers;

use App\models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\models\Cart;

class CartController extends Controller
{   
    public function drop(){
        Session::forget('cart');
        Session::forget('cin');
        Session::forget('cout');
        return redirect()->route('order.form');
    }
    public function destroy($id){
        $oldC=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldC);
        $cart->rItem($id);

        if (count($cart->items)>0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->route('cart.index');
    }
    public function index(){
        if (!Session::has('cart')) {
             return redirect()->route('order.choice',session()->get('hotel_id'));
        }
        $oldC=Session::get('cart');
        $cart=new Cart($oldC);
        return view('cart.index',['cart'=>$cart->items, 'bill'=>$cart->tPrice, 'count'=>$cart->tQty]);
    }
    public function search(){
        if (Session::has('cart')) {
            $oldC=Session::get('cart');
            $cart=new Cart($oldC);
            return view('cart.index',['dKamar'=>$cart->items, 'bill'=>$cart->tPrice, 'count'=>$cart->tQty]);
        }else{
            return view('cart.search');
        }
    }

    public function take($id){
        $cin=session()->get('cin');
        $cout=session()->get('cout');
        $dCin=date_create($cin);
        $dCout=date_create($cout);
        $end=date('Y-m-d', strtotime("-1 days", strtotime(session()->get('cout'))));
        $duration=date_diff($dCin,$dCout);
        $hotel_id=session()->get('hotel_id');;
       
        $end=date('Y-m-d', strtotime("-1 days", strtotime(session()->get('cout'))));
        $where="order_room.id IN(SELECT order_room.id FROM orders inner join order_room on orders.id=order_room.order_id where (('".session()->get('cin')."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".session()->get('cin')."' AND '".$end."')) AND (status!='4' AND status!='2')) AND hotel_id=$hotel_id AND rooms.id=$id";
        $where2="rooms.id NOT IN(SELECT order_room.room_id FROM orders inner join order_room on orders.id=order_room.order_id where (('".session()->get('cin')."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".session()->get('cin')."' AND '".$end." ')) AND (status!='4' AND status!='2')) AND hotel_id=$hotel_id AND rooms.id=$id";
        $union= DB::table('rooms')->selectRaw('rooms.*,slot-SUM(qty) AS quota')
        ->join('order_room','rooms.id','=','order_room.room_id')
        ->whereRaw($where)
        ->groupBy('rooms.id')
        ->havingRaw("slot-SUM(qty)>0");

        $room=  DB::table('rooms')->selectRaw("*, slot as quota")
        ->whereRaw($where2)
        ->groupBy('rooms.id')
        ->union($union)
        ->first();
                
        $oldC=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldC);

        $result=$cart->add($room, $room->id,$duration->days);
        if ($result) {
            $msg="succses, have been added";
        }else{
            $msg="failed, haven't been added. Available quota room is".$room->quota;
        }
        session()->put('cart',$cart);
        
        return redirect()->route('cart.index')->with("msg",$msg);
    }
    public function remove($id){
        $cin=session()->get('cin');
        $cout=session()->get('cout');
        $dCin=date_create($cin);
        $dCout=date_create($cout);
        $duration=date_diff($dCin,$dCout);
        
        $oldC=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldC);
        $cart->rOne($id, $duration->days);

        if (count($cart->items)>0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->route('cart.index');
    }
}
