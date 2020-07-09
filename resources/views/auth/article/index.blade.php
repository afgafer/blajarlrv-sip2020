@extends('layouts.app')
@section('content')
<h1 class="title text-center">articles</h1>
<hr>
@if ($msg = Session::get('msg'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
<div class="card-columns">
            @forelse($articles as $a)
            @php
            $dirF='upload/img/'.$a->file;
            $src=asset($dirF);
            $time=date_create($a->created_at);
            $date=date_format($time,'d/m/Y');
            $content=substr($a->content,0,500);
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('article.showA',$a->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$a->file}}">
                <div class="card-body">
                    <h5>{{$a->title}}</h5>
                    <div>
                        <span class="badge badge-primary">{{$a->admin->name}}</span><span class="badge badge-secondary">{{$date}}</span>
                    </div>
                    <?=$content?>...
                    <div>
                        <a href="{{route('article.showA',$a->id)}}" class="btn btn-primary btn-outline-light btn-sm">read more >></a>
                    </div>
                </div>
                </a>
            </div>
            @empty
            <div class="card p-0">
                <div class="card-body">
                    <h5>empty</h5>
                </div>
            </div>
            @endforelse
            </div>
@endsection