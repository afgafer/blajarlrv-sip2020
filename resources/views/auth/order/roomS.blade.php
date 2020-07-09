@extends('layouts.app')
@section('content')
            <div class="card p-0 col-md-6">
            <?php
            $src='/upload/img/'.$room->file;
            ?>
                <img src="{{$src}}" class="card-img-top" alt="{{$room->file}}">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <table class="table table-sm bg-white mb-2">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>: {{$room->name}}</td>
                            </tr>
                            <tr>
                                <td>price</td>
                                <td>: {{$room->price}}</td>
                            </tr>
                            <tr>
                                <td>cap</td>
                                <td>: {{$room->cap}}</td>
                                <td>quota</td>
                                <td>: {{$quota}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">description :</h5>
                    <p>{{$room->desc}}</p>
                </div>
                <div class="card-footer">
                    @if(Session::has('cart'))
                    @php
                    $cart=Session::get('cart');
                    @endphp
                    <a href="{{route('cart.index')}}"><span class="btn btn-success">cart</span></a>
                    @endif
                </div>
            </div>
    <!-- boodi -->
 @endsection
