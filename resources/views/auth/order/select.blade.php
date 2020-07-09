@extends('layouts.app')
@section('content')
<div class="bg-limpid-light p-2">
            <div>
                <h1 class="title">form</h1>
                <div class="form-row p-2">
                    <div class="form-group col-md-3">
                        <label for="cin">check in :</label>
                        <input type="date"  value="{{Session::get('cin')}}" class="form-control" readonly>
                        <strong>check in 14.00 WIB</strong>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cout">check out :</label>
                        <input type="date" value="{{Session::get('cout')}}" class="form-control" readonly>
                        <strong>check out 12.00 WIB</strong>
                    </div>
                </div>
            </div>
<h1 class="title text-center mt-2">hotels</h1>
<div class="card-columns">
            @forelse($hotels as $h)
            @php
            $dirF='upload/img/'.$h->file;
            $src=asset($dirF);
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('order.choice',$h->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$h->file}}">
                <div class="card-body">
                    <h5 class="card-title text-white badge badge-primary">No {{$h->id}}</h5>
                    <table class="table table-sm bg-white mb-2 ">
                        <tbody>
                            <tr>
                                <td >Name</td>
                                <td>: {{$h->name}}</td>
                            </tr>
                        </tbody>
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
        </div>
@endsection