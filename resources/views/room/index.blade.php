@extends('layouts.app')
@section('content')
<h1 class="title text-center">rooms</h1>
<hr>
@if ($msg = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
<a href="{{route('room.create')}}" class="btn btn-primary btn-sm">create</a>
<div class="card-columns">
            @forelse($rooms as $r)
            @php
            $dirF='upload/img/'.$r->file;
            $src=asset($dirF);
            $price=number_format($r->price,0,',','.');
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('room.show',$r->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$r->file}}">
                <div class="card-body">
                    <h5 class="card-title text-white badge badge-primary">No {{$r->id}}</h5><h5 class="card-title border badge badge-light">Rp {{$price}}</h5>
                    <table class="table table-sm bg-white mb-2 ">
                        <tbody>
                            <tr>
                                <td >Name</td><td>: {{$r->name}}</td>
                            </tr>
                            <tr>
                                <td>hotel</td><td>: {{$r->hotel->name}}</td>
                            </tr>
                            <tr>
                                <td>cap</td><td>: {{$r->cap}}</td>
                            </tr>
                            <tr>
                                <td>slot</td><td>: {{$r->slot}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <a href="{{route('room.edit',$r->id)}}" class="btn btn-primary btn-sm mr-1">edit</a>
                        <form action="{{route('room.destroy',$r->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-danger btn-sm mr-1" type="submit">delete</button>
                        </form>
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
            <h5>empty</h5>
            @endforelse
</div>
@endsection