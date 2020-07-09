<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Dest;
use App\models\Room;
use App\models\Hotel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $type=auth()->user()->type;
        if($type==1){
            $id=auth()->user()->admin->hotel_id;
            if ($id>0) {
                $hotel=Hotel::findOrFail($id);
                return view('home',compact('hotel'));
            }else{
                $dest_id=auth()->user()->admin->dest_id;
                return redirect()->route('dest.show',$dest_id);
            }
        }else if($type==0){
            return redirect()->route('welcome');
        }
    }
}

