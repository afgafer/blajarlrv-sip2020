@extends('layouts.app')
@section('content')
@if (Session::get('message'))
@php
$message = Session::get('message');
@endphp
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<h1 class="bg-secondary text-white text-center">rooms</h1>
<div class="card-columns">
            @foreach($rooms as $r)
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
            <div class="card p-0">
                <a class="text-dark" href="{{route('room.show',$r->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$r->file}}">
                <div class="card-body">
                    <h5 class="card-title text-white badge badge-primary">No {{$r->id}}</h5>
                    <h5 class="card-title border badge badge-light">Rp {{$r->price}}</h5>
                    <table class="table table-sm bg-white mb-2 ">
                        <tbody>
                            <tr>
                                <td >Name</td>
                                <td>: {{$r->name}}</td>
                            </tr>
                            <tr>
                                <td>hotel</td>
                                <td>: {{$r->hotel->name}}</td>
                            </tr>
                            <tr>
                                <td>bed</td>
                                <td>: {{$r->bed}}</td>
                            </tr>
                            <tr>
                                <td>quota</td>
                                <td>: {{$r->quota}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </a>
            </div>
            @endforeach
@endsection