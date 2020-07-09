@extends('layouts.app')
@section('content')
            @php
            $dirF='upload/img/'.$image->file;
            $src=asset($dirF);
            @endphp
            <div class="card">
    <h1 class="title">{{$image->name}}</h1>
    <img src="{{$src}}" alt="{{$image->file}}" class="img-thumbnail col-md-6">
    <div class="card-body">
        <h5>Description :</h5>
        <span class="badge badge-primary">{{$image->dest}}</span>
        <?=$image->desc?>
    </div>
</div>
 @endsection