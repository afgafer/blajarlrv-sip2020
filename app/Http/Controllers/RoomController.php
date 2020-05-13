<?php

namespace App\Http\Controllers;

use App\models\Room;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel_id=Auth()->user()->admin->hotel_id;
        $rooms=Room::where('hotel_id',$hotel_id)->get();
        return view('room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'file' => 'required|file|image|mimes:jpeg,png,gif,webp',
            'price' => ['required', 'integer', 'min:1'],
            'bed' => ['required', 'integer', 'min:1'],
            'slot' => ['required', 'integer', 'min:0'],
            'desc' => ['required',],
        ]);
        $hotel_id=Auth()->user()->admin->hotel_id;
        $room=new Room();
        $room->name=$request->name;
        $file=$request->file;
        if($file){
            $nameF = 'room_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $room->file=$nameF;
        }
        $room->slot=$request->slot;
        $room->price=$request->price;
        $room->bed=$request->bed;
        $room->desc=$request->desc;
        //$room->admins_id=auth()->user()->id;
        $room->hotel_id=$hotel_id;
        $room->save();
        $msg="The rooom ".$room->name." has been stored";

        return redirect()->route('room.index')
                        ->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Kamar  $room
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room= Room::findOrFail($id);
        return view('room.show', compact('room'));
        //return $room->id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Kamar  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room= Room::findOrFail($id);
        return view('room.edit', compact('room'));
        //return $room->id;
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Kamar  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room= Room::findOrFail($id);
        $room->name=$request->name;
        $file=$request->file;
        if($file){
            $oldF='upload/img/'.$room->file;
            File::delete($oldF);
            $nameF = 'room_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $room->file=$nameF;
        }
        $room->slot=$request->slot;
        $room->price=$request->price;
        $room->bed=$request->bed;
        $room->desc=$request->desc;
        //$room->hotel_id=$hotel_id;
        $room->save();
        $msg="The rooom ".$room->name." has been stored";

        return redirect()->route('room.index')
                        ->with('message',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Kamar  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $room= Room::findOrFail($id);
        if(Room::destroy($id)){
            $oldF='upload/img/'.$room->file;
            File::delete($oldF);
            $msg="The room ".$room->name." has deleted";
        }else{
            $msg="The room ".$room->name." hasn't deleted";
        }
        return redirect()->route('room.index')
                ->with('message',$msg);
    }

    public function indexA()
    {
        $rooms=Room::orderBy('id','ASC')->get();
        return view('auth.room.index', compact('rooms'));
    }
    public function check()
    {
        return view('auth.room.check');
    }
    public function search(Request $request){
        $output="";
        if(true){
            $query=$request->get('query');
            $date1=$request->get('date1');
            $date2=$request->get('date2');
            if($query!=''){
                $end=date('Y-m-d', strtotime("-1 days", strtotime($date2)));
                $where="order_room.id IN(SELECT order_room.id FROM orders inner join order_room on orders.id=order_room.order_id where ((('".$date1."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".$date1."' AND '".$end."')) AND (status!='4'))) AND (rooms.name like '%$query%') ";
                $where2="rooms.id NOT IN(SELECT order_room.room_id FROM orders inner join order_room on orders.id=order_room.order_id where ((('".$date1."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".$date1."' AND '".$end." ')) AND (status!='4'))) AND (rooms.phname like '%$query%')";
                $union= DB::table('rooms')->selectRaw('rooms.*,slot-SUM(qty) AS quota')
                ->join('order_room','rooms.id','=','order_room.room_id')
                ->whereRaw($where)
                ->groupBy('rooms.id')
                ->havingRaw("slot-SUM(qty)>0");
                //->get();
                $rooms=  DB::table('rooms')->selectRaw("*, slot as quota")
                ->whereRaw($where2)
                ->groupBy('rooms.id')
                ->union($union)
                ->get();
                
            }else{
                $end=date('Y-m-d', strtotime("-1 days", strtotime($date2)));
                $where="order_room.id IN(SELECT order_room.id FROM orders inner join order_room on orders.id=order_room.order_id where (('".$date1."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".$date1."' AND '".$end."')) AND (status!='4')) ";
                $where2="rooms.id NOT IN(SELECT order_room.room_id FROM orders inner join order_room on orders.id=order_room.order_id where (('".$date1."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".$date1."' AND '".$end." ')) AND (status!='4')) ";
                $union= DB::table('rooms')->selectRaw('rooms.*,slot-SUM(qty) AS quota')
                ->join('order_room','rooms.id','=','order_room.room_id')
                ->whereRaw($where)
                ->groupBy('rooms.id')
                ->havingRaw("slot-SUM(qty)>0");
                //->get();
                $rooms=  DB::table('rooms')->selectRaw("*, slot as quota")
                ->whereRaw($where2)
                ->groupBy('rooms.id')
                ->havingRaw("quota>0")
                ->union($union)
                ->get();
                
            }
            if($rooms->count()>0){
                foreach($rooms as $r){
                    $dirF='upload/img/'.$r->file;
                    $src=asset($dirF);
                    $price=number_format($r->price,0,',','.');

                    $output.="
                    <div class='card p-0'>
                        <a class='text-dark' href='".route('order.room',$r->id)."'>
                        <img src='$src' class='card-img-top' alt='$r->file'>
                        <div class='card-body'>
                            <h5 class='card-title text-white badge badge-primary'>No$r->id</h5>
                            <h5 class='card-title border badge badge-light'>Rp $r->price</h5>
                            <table class='table table-sm bg-white mb-2 '>
                                <tbody>
                                    <tr>
                                        <td >Name</td>
                                        <td>: $r->name</td>
                                    </tr>
                                    <tr>
                                        <td>bed</td>
                                        <td>: $r->bed</td>
                                    </tr>
                                    <tr>
                                        <td>quota</td>
                                        <td>: $r->quota</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </a>
                    </div>
                   ";
                }
            }else{
                $output="
                <div class='card p-0'>
                    <div class='card-body'>
                        empty
                    </div>
                </div>
                ";
            }
            $data=array(
                'card_data'=>$output
            );
        }
        echo json_encode($data);
    }
}

// @foreach($rooms as $r)
// @php
// if(Session::has('cart')){
//     $cart=Session::get('cart');
//     if (array_key_exists($r->id,$cart->items)){
//         continue;
//     }
// }
// $dirF='upload/img/'.$r->file;
// $src=asset($dirF);
// $price=number_format($r->price,0,',','.');
// //dd();
// @endphp
// <div class="card p-0">
//     <a class="text-dark" href="{{route('order.room',$r->id)}}">
//     <img src="{{$src}}" class="card-img-top" alt="{{$r->file}}">
//     <div class="card-body">
//         <h5 class="card-title text-white badge badge-primary">No {{$r->id}}</h5>
//         <h5 class="card-title border badge badge-light">Rp {{$r->price}}</h5>
//         <table class="table table-sm bg-white mb-2 ">
//             <tbody>
//                 <tr>
//                     <td >Name</td>
//                     <td>: {{$r->name}}</td>
//                 </tr>
//                 <tr>
//                     <td>bed</td>
//                     <td>: {{$r->bed}}</td>
//                 </tr>
//                 <tr>
//                     <td>quota</td>
//                     <td>: {{$r->quota}}</td>
//                 </tr>
//             </tbody>
//         </table>
//     </div>
//     </a>
// </div>
// @endforeach
