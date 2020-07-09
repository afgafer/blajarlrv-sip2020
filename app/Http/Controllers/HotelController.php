<?php

namespace App\Http\Controllers;

use App\models\Hotel;
use App\models\Room;
use App\models\Dest;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dest_id=Auth()->user()->admin->dest_id;
        $hotels=Hotel::where('dest_id',$dest_id)->get();
        return view('hotel.index',compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dests=Dest::all();
        return view('hotel.create',compact('dests'));
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
            'contact' => ['required', 'string', 'size:12'], 
            'address' => 'required',
            'desc' => 'required',
            'lat'=>['numeric','nullable'],
            'lng'=>'nullable|numeric',
        ]);
        $hotel=new Hotel();
        $hotel->name=$request->name;
        $file=$request->file;
        if($file){
            $nameF = 'hotel_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $hotel->file=$nameF;
        }
        $hotel->contact=$request->contact;
        $hotel->address=$request->address;
        $hotel->lat=$request->lat;
        $hotel->lng=$request->lng;
        $hotel->desc=$request->desc;
        $hotel->dest_id=auth()->user()->admin->dest_id;
        $hotel->save();
        $msg="The hotel ".$hotel->name." has been saved";

        return redirect()->route('hotel.index')->with('msg',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel=Hotel::findOrFail($id);
        return view('hotel.show',compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel=Hotel::findOrFail($id);
        return view('hotel.edit',compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'file' => 'file|image|mimes:jpeg,png,gif,webp',
            'contact' => ['required', 'string', 'size:12'], 
            'address' => 'required',
            'desc' => 'required',
            'lat'=>['numeric','nullable'],
            'lng'=>'nullable|numeric',
        ]);
        $hotel=Hotel::findOrFail($id);
        $hotel->name=$request->name;
        $file=$request->file;
        if($file){
            $oldF='upload/img/'.$hotel->file;
            File::delete($oldF);
            $nameF = 'hotel_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $hotel->file=$nameF;
        }
        $hotel->contact=$request->contact;
        $hotel->address=$request->address;
        $hotel->lat=$request->lat;
        $hotel->lng=$request->lng;
        $hotel->desc=$request->desc;
        $hotel->save();
        $msg="The hotel ".$hotel->name." has been saved";

        return redirect()->route('hotel.show',$id)->with('msg',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel=Hotel::findOrFail($id);
        $oldF='upload/img/'.$hotel->file;
        File::delete($oldF);
        Hotel::destroy($id);
        $msg="The hotel ".$hotel->name." has been deleted";
        return redirect()->route('hotel.index')->with('msg',$msg);
    }

    public function indexA()
    {
        $hotels=Hotel::orderBy('name','ASC')->get();
        return view('auth.hotel.index',compact('hotels'));
    }

    public function map(){
        $hotels=Hotel::get();
        return view('auth.hotel.map', compact('hotels'));
    }
}
