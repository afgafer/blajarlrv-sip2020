@extends('layouts.app')
@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
<h1 class="title">Article</h1>
<form action="{{route('article.store')}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="title">title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="title" required>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-4">
                        <label for="file">image</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" >
                        @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 p-0">
                        <label for="content">content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="editor" name="content"></textarea>
                        @error('content')
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