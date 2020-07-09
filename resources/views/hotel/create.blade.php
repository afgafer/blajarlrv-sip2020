@extends('layouts.app')
@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
<h1 class="title">hotel</h1>
<form action="{{route('hotel.store')}}" method='post' enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-row">
        <div class="col-md-6">
            <label for="name">name</label>
            <input type="text" class="form-control @error('name') is-invaliid @enderror" name="name" placeholder="name"
                required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-7">
            <label for="file">image</label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file">
            @error('file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-3">
            <label for="contact">contact</label>
            <input type="number" class="form-control @error('contact') is-invalid @enderror" name="contact"
                placeholder="contact" required>
            @error('contact')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4">
            <div class="col-md-12 p-0">
                <label for="lat">latitude</label>
                <input type="text" class="form-control @error('lat') is-invalid @enderror" name="lat" placeholder="latitude">
                <span>can be empty</span>
                @error('lat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-12 p-0">
                <label for="lng">longitude</label>
                <input type="text" class="form-control @error('lng') is-invalid @enderror" name="lng" placeholder="longitude">
                <span>can be empty</span>
                @error('lng')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="address">address</label>
            <textarea class="form-control h-75 @error('address') is-invalid @enderror" name="address"></textarea>
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group col-12 p-0">
            <label for="desc">description</label>
            <textarea class="form-control @error('desc') is-invalid @enderror" id="editor" name="desc"></textarea>
            @error('desc')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
    </div>
    <div class="form-group">
        <div class="col-12 ">
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