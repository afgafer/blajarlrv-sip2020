@extends('layouts.app')
@section('content')
<!-- order form -->
<form action="{{route('order.store')}}" method="post">
    {{csrf_field()}}
    <h1 class="title">hanida hotel</h1>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">name</label>
            <input type="text" value="{{Auth::user()->name}}" name='name'
                class="form-control @error('name') is-invalid @enderror">
        </div>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="form-group col-md-3">
            <label for="hotel_id">hotel</label>
            <input type="text" value="{{Session::get('hotel')}}" name='hotel_id' class="form-control" readonly>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="cin">check in :</label>
            <input type="date" value="{{Session::get('cin')}}" name='cin' class="form-control" readonly>
            <strong>14.00 WIB</strong>
        </div>
        <div class="form-group col-md-3">
            <label for="cout">check out :</label>
            <input type="date" value="{{Session::get('cout')}}" name='cout' class="form-control" readonly>
            <strong>12.00 WIB</strong>
        </div>
        <div class="form-group col-md-3">
            <label for="contact">contact :</label>
            <input type="text" placeholder="input your contact" name="contact"
                class="form-control  @error('contact') is-invalid @enderror">
            @error('contact')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    @if ($msg = Session::get('msg'))
    <div class="alert alert-info col-9" role="alert">
        {{$msg}}
    </div>
    @endif
    <button class="btn btn-success btn-sm mb-2" type="submit">order</button>
</form>
<!--end order form -->
<!-- scroll -->
<div class="scroll" style="width:80vw">
    <table class="table-sm table-striped">
        <tr class="bg-dark text-white">
            <th>No</th>
            <th>room</th>
            <th>price</th>
            <th>quantity</th>
            <th></th>
        </tr>
        @foreach($cart as $c)
        @php
        $cost=number_format($c['cost'],0,'','.')
        @endphp
        <tr>
            <td><a href="{{route('order.roomshow',$c['item']->id)}}">{{$c['item']->id}}</a></td>
            <td><a href="{{route('order.roomshow',$c['item']->id)}}">{{$c['item']->name}}</a></td>
            <td>Rp {{$cost}}</td>
            <td>
                <div class="row" style="width:200px">
                    <div class="d-inline">
                        <form action="{{route('cart.take',$c['item']->id)}}" method="post">
                            @csrf
                            <button class="btn btn-secondary btn-sm" type="submit">+</button>
                        </form>
                    </div>
                    <div class="d-inline" style="width:50px">
                        <input type="number" value="{{$c['qty']}}" max="{{$c['item']->quota}}" class="form-control p-0"
                            readonly>
                    </div>
                    <div class="d-inline">
                        <form action="{{route('cart.remove',$c['item']->id)}}" method="post">
                            @csrf
                            <button class="btn btn-secondary btn-sm" type="submit">-</button>
                        </form>
                    </div>
                </div>
            </td>
            <td>
                <form action="{{route('cart.destroy',$c['item']->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('POST')}}
                    <button class="btn btn-danger btn-sm" type='submit'>delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @php
        $billF=number_format($bill,0,'','.')
        @endphp
        <tr>
            <th colspan="2" class=>price total</th>
            <th class="text-danger text-weight-bold">Rp {{$billF}}</th>
            <th>total : {{$count}} room</th>
            <th></th>
        </tr>
    </table>
</div>
<!-- scroll -->
<p>
    <ul>
        Annotation :
        <li>Before check in has to make 100% paychecks </li>
        <li>Check in time on 14.00 WIB and Check out on time 12.00 WIB</li>
    </ul>
</p>
<!-- btn-group -->
<div class="btn-group">
    <!-- <form action="{{route('order.choice',session()->get('hotel_id'))}}" method="get"> -->
    <a href="{{route('order.choice',session()->get('hotel_id'))}}"><button class="btn btn-primary btn-sm" type='submit'>choice</button></a>
    <!-- </form> -->
    <form action="{{route('cart.drop')}}" method="post">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button class="btn btn-warning btn-sm" type='submit'>cancel</button>
    </form>
</div>
<!--end btn-group -->
@endsection