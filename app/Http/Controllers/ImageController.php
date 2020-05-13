<?php

namespace App\Http\Controllers;

use App\models\image;
use App\models\Dest;
use Illuminate\Http\Request;
use File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dest_id=Auth()->user()->admin->dest_id;
        $images=Image::orderBy('created_at','DESC')->whereRaw("status='0' and dest_id=$dest_id")->get();
        return view('image.index',['images'=>$images]);
    }

     public function indexA()
    {
        $images=Image::where('status','=','1')->get();
        //dd($images);
        return view('auth.image.index',['images'=>$images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dests=Dest::orderBy('name','asc')->get();
        return view('image.create',compact('dests'));
    }

    public function createA()
    {
        $images=Image::orderBy('created_at','DESC')->whereRaw("status!='1'")->get();

        $dests=Dest::orderBy('name','asc')->get();
        return view('auth.image.create',compact('dests','images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'name'=>'required',
            'file' => 'required|file|image|mimes:jpeg,png,gif,webp',
            'dest_id'=>'required',
            'desc'=>'required',   
        ]);

        $image=new Image();
        $image->name=$request->name;
        $file=$request->file;
        if($file){
            $nameF = 'image_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $image->file=$nameF;
        }
        $image->desc=$request->desc;
        $image->status='0';
        $image->user_id=auth()->user()->id;
        $image->dest_id=$request->dest_id;
        $image->save();
        $msg="The image ".$image->name." has been stored";

        return redirect()->route('image.create')
                ->with('message',$msg);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\images  $images
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\images  $images
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image=Image::findOrFail($id);
        return view('image.edit',compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\images  $images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request,[
            'name'=>'required',
            'file' => 'required|file|image|mimes:jpeg,png,gif,webp',
            'dest_id'=>'required',
            'desc'=>'required',
        ]);
        $image=Image::findOrFail($id);
        $image->name=$request->name;
        $file=$request->file;
        if($file){
            $oldF='upload/img/'.$image->file;
            File::delete($oldF);
            $nameF = 'image_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $image->file=$nameF;
        }
        $image->desc=$request->desc;
        $image->status='0';
        $image->user_id=auth()->user()->id;
        $image->dest_id=$request->dest_id;
        $image->save();
        $msg="The image ".$image->name." has been stored";
        return redirect()->route('image.indexA')
                ->with('message',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\images  $images
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image= Image::findOrFail($id);
        Image::destroy($id);
        $oldF='upload/img/'.$image->file;
        File::delete($oldF);
        $msg="The image ".$image->name." has deleted";

        return redirect()->back()
                ->with('message',$msg);
    }

    public function pConfirm(Request $request,$id)
    {
        $image=Image::findOrFail($id);
        $image->status=$request->status;
        $image->save();
        $msg="The image ".$image->name." has been upload";

        return redirect()->route('image.index')
                ->with('message',$msg);
    }

}
