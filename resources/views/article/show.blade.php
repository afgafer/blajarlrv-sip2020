@extends('layouts.app')
@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection

@php
$dirF='upload/img/'.$article->file;
$src=asset($dirF);
@endphp

@section('content')
                <div class="card">
                    <h1 class="title">{{$article->title}}</h1>
                    <hr>
                    <div class="col-md-6">
                        <img src="{{$src}}" alt="{{$article->file}}" class="img-thumbnail w-100 h-100">
                    </div>
                    <div class="card-body">
                    <?=$article->content?>
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