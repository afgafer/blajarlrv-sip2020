@extends('lay.app')
@section('content')
            <form action="{{route('pesan.store')}}" method='post'>
            {{csrf_field()}}
                <div class="form-row">
                    <div class="col-md-8 mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{session()->get('namaPemesan')}}" readonly>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label for="jumlah">jumlah</label>
                        <input type="number" name="jumlah" class="form-control" value="{{session()->get('jumlah')}}" readonly>
                    </div>
                </div>
                        @php
                        $foto='storage/upload/img/'.$kamar[0]->foto;
                        @endphp
                    <img src="{{asset($foto)}}" clas="w-25 border-rounded">
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-3">
                        <label for="id_kamar">kamar</label>
                        <input type="hidden"  name="id_kamar" class="form-control" value="{{$kamar[0]->id}}">
                        <input type="hidden"  name="harga" class="form-control" value="{{$kamar[0]->harga}}">
                        <input type="text" class="form-control" value="{{$kamar[0]->nama}}" readonly>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label for="harga">harga</label>
                        <input type="number" class="form-control" value="{{$kamar[0]->harga}}" readonly>
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-6 mb-4">
                        <label for="masuk">masuk</label>
                        <input type="date" class="form-control" name="masuk"  value="{{session()->get('masuk')}}" readonly>
                    </div>
                    <div class="col-6 mb-1">
                        <label for="keluar">keluar</label>
                        <input type="date" class="form-control" name="keluar"  value="{{session()->get('keluar')}}" readonly>
                    </div>
                </div>
                <!-- <div class="form-row mx-2">
                    <div class="col-3 mb-3">
                        <label for="biaya">biaya</label>
                        <input type="number" class="form-control" name="biaya" value="$kamar[0]->harga" required>
                    </div>
                    <div class="col-3 mb-1">
                        <label for="trasaksi">trasaksi</label>
                        <input type="number" class="form-control" name="trasaksi" placeholder="transaksi" required>
                    </div>
                </div> -->
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
 @endsection