<?php

namespace App\Http\Controllers;

use App\User;
use App\models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dests= \App\models\Dest::orderBy('name','ASC')->get();
        $hotels= \App\models\Hotel::orderBy('name','ASC')->get();
        $admins=Admin::orderBy('dest_id','ASC')->get();
        return view('admin.index',compact('admins','dests','hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin=auth()->user();
        if (!Gate::allows('admin-create', $admin))
        {
            $msg=$admin->name." aren't user 1";
            return redirect()->route('admin.index')
                    ->with('message',$msg);
        }
        $dests= \App\models\Dest::orderBy('name','ASC')->get();
        $hotels= \App\models\Hotel::orderBy('name','ASC')->get();
        return view('admin.create',compact('dests','hotels'));
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => ['required', 'string', 'size:12'], //hmm
            'dest_id' => 'required|numeric',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->contact=$request->contact;
        $user->password=Hash::make($request->password);
        $user->type='1';
        $user->save();

        $user=User::where('email',$request->email)->first();
        $admin=new Admin();
        $admin->name=$request->name;
        $admin->hotel_id=$request->hotel_id;
        $admin->dest_id=$request->dest_id;
        $admin->user_id=$user->id;
        $admin->file='default.jpg';
        $admin->save();
        $msg="The admin ".$admin->name." has been stored";

        return redirect()->route('admin.index')
                ->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin=Admin::where('user_id',$id)->firstOrFail();
        $dests= \App\models\Dest::orderBy('name','ASC')->get();
        $hotels= \App\models\Hotel::orderBy('name','ASC')->get();
        $admins=Admin::orderBy('dest_id','ASC')->get();
        return view('admin.show',compact('admin','admins',"dests",'hotels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $admin=Admin::where('user_id',$id)->first();
        //dd($admin->user_id);
        // //dd(auth()->user()->id);
        if (!Gate::allows('admin-edit', $admin))
        {
            $msg="user ".auth()->user()->id." aren't admin ".$admin->user_id;
            return redirect()->route('admin.index')
            ->with('message',$msg);
        }
        $dests= \App\models\Dest::orderBy('name','ASC')->get();
        $hotels= \App\models\Hotel::orderBy('name','ASC')->get();
        return view('admin.edit',compact('dests','hotels','admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required',
            'contact' => ['required', 'string', 'size:12'],
            'dest_id' => 'required|gt:0',
        ]);
        $user=User::findOrFail($id);
        $user->name=$request->name;
        $user->contact=$request->contact;
        $user->type='1';
        $user->save();

        $admin=Admin::where('user_id',$id)->firstOrfail();
        $admin->name=$request->name;
        $admin->hotel_id=$request->hotel_id;
        $admin->dest_id=$request->dest_id;
        $admin->save();
        $msg="The admin ".$admin->name." has been saved";

        return redirect()->route('admin.show',$id)
                ->with('message',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::destroy($id);
        $user=User::destroy($id);
    }
    public function upload(Request $request,$id){
        $this->validate($request,[
            'file'=>'required|file|image|mimes:jpeg,png,gif,webp',
        ]);
        $admin=Admin::findOrFail($id);
        $file=$request->file;
        if ($file) {
            $dirF='upload/img/';
            $oldF=$dirF.$admin->file;
            File::delete($oldF);
            $nameF='admin_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($dirF,$nameF);
            $admin->file=$nameF;
        }
        $admin->save();
        return back()->with('msg',"Profille's photo has been upload");
    }
}
