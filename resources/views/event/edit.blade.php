@extends('layouts.app')
@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
@php
$dirF='upload/img/'.$event->file;
$src=asset($dirF);
@endphp
<h1 class="title">Event</h1>
            <form action="{{route('event.update',$event->id)}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="name">name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$event->name}}" required>
                        @error('name') 
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <img src="{{$src}}" alt="{{$event->file}}" class="img-thumbnail">
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file">
                        @error('file') 
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="date">date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{$event->date}}" required>
                        @error('date') 
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-6 mb-4">
                        <label for="place">place</label>
                        <input type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{$event->place}}" required>
                        @error('place') 
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="desc">desc</label>
                        <textarea class="form-control @error('desc') is-invalid @enderror" id="editor" name="desc">{{$event->desc}}</textarea>
                        @error('desc') 
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
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