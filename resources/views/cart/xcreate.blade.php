@extends('lay.app')
@section('content')
<div class="container">
@if(Session::has('namaPemesan'))
    <form action="{{route('cart.search')}}" method='post'>
    {{csrf_field()}}
                <div class="form-row mx-2">
                    <div class="col-8 mb-4">
                        <label for="namaOrang">namaPemesan</label>
                        <input type="text" class="form-control" name="namaPemesan" value="{{session()->get('namaPemesan')}}" readonly>
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-6 mb-4">
                        <label for="masuk">masuk</label>
                        <input type="date" class="form-control" name="masuk" value="{{session()->get('masuk')}}" readonly>
                    </div>
                    <div class="col-6 mb-1">
                        <label for="keluar">keluar</label>
                        <input type="date" class="form-control" name="keluar" value="{{session()->get('keluar')}}" readonly>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Kembali</button>
            </form>
@endif
</div>
<div class="card-columns">
            @foreach($kamar as $d)
            @php
            if(Session::has('cart')){
                $cart=Session::get('cart');
                if (array_key_exists($d->id,$cart->items)){
                    continue;
                }
            }
            $foto='storage/upload/img/'.$d->foto;
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('kamar.show',$d->id)}}">
                <img src="{{asset($foto)}}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title text-white badge badge-secondary">Rp {{$d->id}}</h5>
                    <h5 class="card-title text-white badge badge-secondary">Rp {{$d->harga}}</h5>
                    <table class="table table-sm bg-white mb-2 ">
                        <tbody>
                            <tr>
                                <td >Nama kamar</td>
                                <td>: {{$d->nama}}</td>
                            </tr>
                            <tr>
                                <td>bed</td>
                                <td>: {{$d->bed}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{route('cart.show',['id'=>$d->id])}}" method="post">
                    {{csrf_field()}}
                        <button type="submit" class="btn btn-primary"> Pesan</button>
                    </form>
                </div>
                </a>
            </div>
            @endforeach
@endsection