<?php

namespace App\Http\Controllers;

use App\models\Article;
use Illuminate\Http\Request;
use File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id=auth()->user()->admin->id;
        $articles=Article::orderBy('created_at','desc')->where('admin_id',$admin_id)->get();
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
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
            'title' => ['required', 'string', 'max:255'],
            'file' => 'required|file|image|mimes:jpeg,png,gif,webp',
            'content' => 'required',
        ]);
        $article=new Article();
        $article->title=$request->title;
        $file=$request->file;
        if($file){
            $nameF = 'article_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $article->file=$nameF;
        }
        $article->content=$request->content;
        $article->admin_id=auth()->user()->admin->id;
        $article->save();
        $msg="The article ".$article->name." has been saved";

        return redirect()->route('article.index')->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article=Article::findOrFail($id);
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::findOrFail($id);
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'title' => ['required', 'string', 'max:255'],
            'file' => 'file|image|mimes:jpeg,png,gif,webp',
            'content' => 'required',
        ]);
        $article=Article::findOrFail($id);
        $article->title=$request->title;
        $file=$request->file;
        if($file){
            $oldF='upload/img/'.$article->file;
            File::delete($oldF);
            $nameF = 'article_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $article->file=$nameF;
        }
        $article->content=$request->content;
        $article->save();
        $msg="The article ".$article->name." has been saved";

        return redirect()->route('article.index')->with('message',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article=Article::findOrFail($id);
        $oldF='upload/img/'.$article->file;
        File::delete($oldF);
        Article::destroy($id);
        $msg="The article ".$article->name." has been deleted";
        return redirect()->route('article.index')->with('message',$msg);
    }

    public function indexA()
    {
        $articles=Article::orderBy('created_at','desc')->get();
        return view('auth.article.index',compact('articles'));
    }
    
}
