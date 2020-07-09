<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use File;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(member $member,$id)
    {
        $member=Member::where('user_id',$id)->firstOrFail();
        return view('member.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(member $member)
    {
        //
    }
    public function upload(Request $request,$id){
        $this->validate($request,[
            'file'=>'required|file|image|mimes:jpeg,png,gif,webp',
        ]);
        $member=Member::findOrFail($id);
        $file=$request->file;
        if ($file) {
            $dirF='upload/img/';
            $oldF=$dirF.$member->file;
            File::delete($oldF);
            $nameF='member_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($dirF,$nameF);
            $member->file=$nameF;
        }
        $member->save();
        return back()->with('msg',"Profille's photo has been upload");
    }
}
