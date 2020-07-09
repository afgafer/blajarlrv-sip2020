@extends('layouts.app')
@section('content')
<h1 class="title text-center">hotels</h1>
<hr>
@if ($msg = Session::get('msg'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
<!-- card-clumns -->
<div class="card-columns">
    @forelse($hotels as $h)
    @php
    $dirF='upload/img/'.$h->file;
    $src=asset($dirF);
    @endphp
    <!-- box-->
    <div class="box">
        <a class="text-white" href="{{route('hotel.showA',$h->id)}}">
            <img src="{{$src}}" class="card-img-top border border-secondary" alt="{{$h->file}}">
            <div class="box-title">
                <h5>{{$h->name}}</h5>
            </div>
        </a>
    </div>
    <!--end box-->
    @empty
    <!--card-->
    <div class="card p-0">
        <div class="card-body">
            <h5>empty</h5>
        </div>
    </div>
    <!--end card -->
    @endforelse
</div>
<!--end card-clumns -->
@endsection