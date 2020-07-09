@extends('layouts.app')
@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
<h1 class="title">rooom</h1>
            <form action="{{route('room.update',$room->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{ method_field('PUT') }}
                <div class="form-group">
                    <div class="col-md-5 mb-1">
                        @php
                        $dirF='upload/img/'.$room->file;
                        $src=asset($dirF);
                        @endphp
                        <img src="{{$src}}" class="img-thumbnail img-m" alt="{{$room->file}}">
                </div>
                <div class="form-group">
                    <div class="col-md-5 mb-1">
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" >
                        @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 mb-4">
                        <label for="name">name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$room->name}}" required>
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mx-2">
                    <div class="col-md-4 mb-4">
                        <label for="price">price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$room->price}}" required>
                        @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="cap">capacity</label>
                        <input type="number" class="form-control @error('cap') is-invalid @enderror" name="cap" value="{{$room->cap}}" required>
                        @error('cap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="slot">slot</label>
                        <input type="number" class="form-control @error('slot') is-invalid @enderror" name="slot" value="{{$room->slot}}" required>
                        @error('slot')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 mb-3">
                        <label for="desc">description</label>
                        <textarea class="form-control @error('desc') is-invalid @enderror" id="editor" name="desc">{{$room->desc}}</textarea>
                        @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">save</button>
            </form>
 @endsection
 @section('script')
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection