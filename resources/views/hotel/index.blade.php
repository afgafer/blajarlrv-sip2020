@extends('layouts.app')
@section('content')
<h1 class="title text-center">hotels</h1>
<hr>
<!-- alert -->
@if ($msg = Session::get('msg'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
<!--end alert -->
<a href="{{route('hotel.create')}}" class="btn btn-primary btn-sm">create</a>
<div class="card-columns">
            @forelse($hotels as $h)
            @php
            $dirF='upload/img/'.$h->file;
            $src=asset($dirF);
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('hotel.show',$h->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$h->file}}">
                <div class="card-body">
                    <h5 >{{$h->name}}</h5>
                    <div class="btn-group">
                        <a href="{{route('hotel.edit',$h->id)}}" class="btn btn-primary btn-sm">edit</a>
                        <form action="{{route('hotel.destroy',$h->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-danger btn-sm mr-1" type="submit">delete</button>
                        </form>
                    </div>
                </div>
                </a>
            </div>
            @empty
            <h5>empty</h5>
            @endforelse
        </div>
@endsection