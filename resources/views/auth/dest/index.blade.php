@extends('layouts.app')
@section('content')
<h1 class="title">destiations</h1>
<hr>
@if ($msg = Session::get('msg'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
<div class="card-columns">
            @forelse($dests as $d)
            @php
            $dirF='upload/img/'.$d->file;
            $src=asset($dirF);
            @endphp
            <div class="box">
                <a class="text-white" href="{{route('dest.showA',$d->id)}}">
                <img src="{{$src}}" class="card-img-top border border-secondary" alt="{{$d->file}}">
                <div class="box-title">
                    <h5 >{{$d->name}}</h5>
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