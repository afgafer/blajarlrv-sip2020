@extends('layouts.app')
@section('content')
<h1 class="title">events</h1>
<hr>
@if ($msg = Session::get('msg'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
@forelse($events as $e)
    @php
    $dirF='upload/img/'.$e->file;
    $src=asset($dirF);
    $time=date_create($e->date);
    $date=date_format($time,'d/m/Y');
    $content=substr($e->desc,0,250);
    $mod=$loop->iteration%2;
    @endphp
    @if($mod)
    <div class="card mb-3 p-1"> 
        <div class="row no-gutters">
            <div class="col-md-3 align-self-center">
                <img src="{{$src}}" class="card-img" alt="{{$e->file}}">
            </div>
            <div class="col-md-8 ">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{$e->name}}</h4>
                    <p class="card-text"><?=$content?>... <a href="{{route('event.showA',$e->id)}}">read more</a></p>
                    <p class="card-text">
                        <span class="badge badge-secondary">{{$e->place}}</span><span class="badge badge-light border">{{$date}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card mb-3 p-1">
        <div class="row no-gutters">
             <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{$e->name}}</h4>
                    <p class="card-text"><?=$content?>... <a href="{{route('event.showA',$e->id)}}">read more</a></p>
                    <p class="card-text">
                        <span class="badge badge-secondary">{{$e->place}}</span><span class="badge badge-light border">{{$date}}</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3 align-self-center ml-auto">
                <img src="{{$src}}" class="card-img" alt="{{$e->file}}">
            </div>
            
        </div>
    </div>
    @endif
    @empty
    <h5>empty</h5>
    @endforelse
@endsection