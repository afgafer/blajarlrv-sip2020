<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\user;
use App\models\Order;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('type','desc')->get();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dests=\App\models\Dest::orderBy('name','ASC')->get();
        return view('user.create',compact('dests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($reques,[
            
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->contact=$request->contact;
        $user->password=Hash::make($request->password);
        $user->type='1';
        $user->save();


        $msg="The admin ".$user->name." has been stored";

        return redirect()->route('admin.index')
                ->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findOrFail($id);
        $transaction=Order::selectRaw("count(id) as count")->where('hotel_id',$user->admin->hotel->id)->first();
        $whereP="hotel_id=".$user->admin->hotel->id." and status='1'";
        $payment=Order::selectRaw("count(id) as count")->whereRaw($whereP)->first();
        $whereO="hotel_id=".$user->admin->hotel->id." and status='3'";
        $order=Order::selectRaw("count(id) as count")->whereRaw($whereO)->first();
        return view('user.show',compact('user','transaction','payment','order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $user->name=$request->name;
        $file=$request->file;
        if($file){
            $oldF='upload/img/'.$user->file;
            File::delete($oldF);
            $nameF = 'user_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $user->file=$nameF;
        }
        $user->email=$request->email;
        $user->contact=$request->contact;
        $user->save();
        $msg="The user ".$user->name." has been saved";

        return redirect()->route('user.index')->with('message',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
