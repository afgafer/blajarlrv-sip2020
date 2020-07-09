<?php

namespace App\Http\Controllers;

use App\models\Event;
use Illuminate\Http\Request;
use File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events=Event::orderBy('created_at','desc')->where('admin_id',auth()->user()->admin->id)->get();
        return view('event.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
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
            'date' => 'required|date|after_or_equal:now', 
            'place' => 'required',
            'desc' => 'required',
        ]);
        $event=new Event();
        $event->name=$request->name;
        $file=$request->file;
        if($file){
            $nameF = 'event_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $event->file=$nameF;
        }
        $event->date=$request->date;
        $event->place=$request->place;
        $event->desc=$request->desc;
        $event->admin_id=auth()->user()->id;
        $event->save();
        $msg="The event ".$event->name." has been saved";

        return redirect()->route('event.index')->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event=Event::findOrFail($id);
        return view('event.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::findOrFail($id);
        return view('event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'file' => 'file|image|mimes:jpeg,png,gif,webp',
            'date' => 'required|date|after_or_equal:now', 
            'place' => 'required',
            'desc' => 'required',
        ]);
        $event=Event::findOrFail($id);
        $event->name=$request->name;
        $file=$request->file;
        if($file){
            $oldF='upload/img/'.$event->file;
            File::delete($oldF);
            $nameF = 'event_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $event->file=$nameF;
        }
        $event->date=$request->date;
        $event->place=$request->place;
        $event->desc=$request->desc;
        $event->save();
        $msg="The event ".$event->name." has been saved";

        return redirect()->route('event.index')->with('message',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Event::findOrFail($id);
        $oldF='upload/img/'.$event->file;
        File::delete($oldF);
        Event::destroy($id);
        $msg="The event ".$event->name." has been deleted";
        return back()->with('message',$msg);
    }
    public function indexA()
    {
        $events=Event::orderBy('created_at','desc')->get();
        return view('auth.event.index',compact('events'));
    }
}
