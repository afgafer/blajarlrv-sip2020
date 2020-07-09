@extends('layouts.app')
@section('content')
<a href="{{route('order.form')}}" class="btn btn-primary">order</a>

@forelse($orders as $o)
    <!-- card -->
    <div class="card p-0 font-weight-bold text-capitalize">
            @php
            @endphp
                <div class="card-header d-flex">
                    <a class="mr-auto" href="{{route('order.showA',$o->id)}}">{{$o->invoice}}</a>
                    <?=$o->getBStatus()?>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            name : {{$o->name}}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-2">
                            cin : {{$o->getCin()}}
                        </div>
                        <div class="form-group col-sm-2">
                            cout : {{$o->getCout()}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-info">{{$o->getBill()}}</div> 
                    </div>
                </div>
                <div class="card-footer bg-white">
                    @if($o->status==3)
                        <button class="btn btn-success btn-sm" disabled>upload</button>
                    @else
                        <a href="{{route('order.showA',$o->id)}}" class="btn btn-success btn-sm">upload</a>
                    @endif
                </div>
            </div>
    <!--end card -->
    @empty
    <div class="card mb-3 p-1"> 
        <div class="card-body">
            empty
        </div>
    </div>
    @endforelse

<!-- <div class="scroll">
        <table class="table table-sm bg-limpid-light">
            <thead>
                <tr class='bg-primary text-white'>
                    <th>No</th>
                    <th>name</th>
                    <th>cin</th>
                    <th>bill</th>
                    <th>status</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
            @php
            @endphp

                @forelse($orders as $o)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{route('order.showA',$o->id)}}">{{$o->name}}</a></td>
                    <td>{{$o->cin}}</td>
                    <td>{{$o->bill}}</td>
                    <td>{{$o->getStatus($o->status)}}</td>
                    <td>
                    @if($o->status==3)
                        <button class="btn btn-success" disabled>upload</button>
                    @else
                        <a href="{{route('order.showA',$o->id)}}" class="btn btn-success">upload</a>
                    @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td>empty</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div> -->
@endsection