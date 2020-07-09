@extends('layouts.app')
@section('header')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
@php
$dirF='upload/img/'.$event->file;
$src=asset($dirF);
@endphp
<div class="card">
    <h1 class="title">{{$event->name}}</h1>
    <img src="{{$src}}" alt="{{$event->file}}" class="img-thumbnail col-md-6">
    <div class="card-body">
        <span class="badge badge-primary">{{$event->place}}</span>
        <span class="badge badge-light border border-dark">{{$event->getDate()}}</span>
        <h5>description</h5>
        <?=$event->desc?>
    </div>
</div>
@endsection
@section('script')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection