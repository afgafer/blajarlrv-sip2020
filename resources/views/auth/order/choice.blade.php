@extends('layouts.app')
@section('content')
<div class="bg-limpid-light p-2">
            <div class="">
                <h1 class="title">form</h1>
                <div class="form-row p-2">
                    <div class="form-group col-md-2">
                        <label for="hotel">hotel</label>
                        <input type="text" value="{{Session::get('hotel')}}" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cin">check in :</label>
                        <input type="date"  value="{{Session::get('cin')}}" class="form-control" readonly>
                        <strong>check in 14.00 WIB</strong>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cout">check out :</label>
                        <input type="date" value="{{Session::get('cout')}}" class="form-control" readonly>
                        <strong>check out 12.00 WIB</strong>
                    </div>
                </div>
            </div>
<h1 class="title text-center mt-2">rooms</h1>
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
            $price=number_format($r->price,0,',','.');
            //dd();
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('order.room',$r->id)}}">
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
                                <td>cap</td>
                                <td>: {{$r->cap}}</td>
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
            @empty
            <div class="card">
                <div class="card-body">
                    empty
                </div>
            </div>
            @endforelse
        </div>
        </div>
@endsection