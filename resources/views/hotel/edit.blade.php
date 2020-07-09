@extends('layouts.app')
@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
@php
$dirF='upload/img/'.$hotel->file;
$src=asset($dirF);
@endphp
<h1 class="title">hotel</h1>
            <form action="{{route('hotel.update',$hotel->id)}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="name">name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$hotel->name}}" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <img src="{{$src}}" class="img-thumbnail" alt="{{$hotel->file}}">
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" >
                        @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="contact">contact</label>
                        <input type="number" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{$hotel->contact}}" required>
                        @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="address">address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{$hotel->address}}</textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="lat">lat</label>
                        <input type="text" class="form-control @error('lat') is-invalid @enderror" name="lat" value="{{$hotel->lat}}">
                        @error('lat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="lng">lng</label>
                        <input type="text" class="form-control @error('lng') is-invalid @enderror" name="lng" value="{{$hotel->lng}}">
                        @error('lng')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="desc">desc</label>
                        <textarea class="form-control @error('desc') is-invalid @enderror" id="editor" name="desc">{{$hotel->desc}}</textarea>
                        @error('desc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <button class="btn btn-primary" type="submit">save</button>
                        </div>
                </div>
            </form>
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