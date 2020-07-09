@extends('layouts.app')
@section('content')
<h1 class="title text-center">images</h1>
<hr>
@if ($msg = Session::get('msg'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
<div class="card-columns">
            @forelse($images as $i)
            @php
            $dirF='upload/img/'.$i->file;
            $src=asset($dirF);
            @endphp
            <div class="box card">
                <a class="text-white" href="{{route('image.show',$i->id)}}">
                <img src="{{$src}}" class="card-img-top border border-secondary" alt="{{$i->file}}">
                <div class="overlay">
                    <h5 >{{$i->name}}</h5>
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