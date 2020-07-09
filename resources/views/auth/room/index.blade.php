@extends('layouts.app')
@section('content')
<h1 class="title text-center">rooms</h1>
<hr>
@if ($msg = Session::get('msg'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
<div class="card-columns">
            @forelse($rooms as $r)
            @php
            if(Session::has('cart')){
                $cart=Session::get('cart');
                if (array_key_exists($r->id,$cart->items)){
                    continue;
                }
            }
            $dirF='upload/img/'.$r->file;
            $src=asset($dirF);
            $price=number_format($r->price,0,',','.')
            @endphp
            <div class="card p-0 ">
                <a class="text-dark" href="{{route('room.showA',$r->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$r->file}}">
                <div class="card-body">
                    <h5 class="card-title text-white badge badge-primary">No {{$r->id}}</h5>
                    <h5 class="card-title border badge badge-light">Rp {{$r->price}}</h5>
                    <table class="table table-sm mb-2 font-weight-bold">
                            <tr>
                                <td >Name</td>
                                <td>: {{$r->name}}</td>
                            </tr>
                            <tr>
                                <td>cap</td>
                                <td>: {{$r->cap}}</td>
                            </tr>
                            <tr>
                                <td>hotel</td>
                                <td>: {{$r->hotel->name}}</td>
                            </tr>
                    </table>
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