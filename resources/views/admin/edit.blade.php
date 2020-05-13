@extends('layouts.app')
@section('header')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
                    <form method="POST" action="{{ route('admin.update',$user->email) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required >
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @php
                        $dirF='upload/img/'.$user->file;
                        $src=asset($dirF);
                        @endphp
                        <div class="form-group">
                            <img src="{{$src}}" class="img-thumbnail" alt="{{$user->file}}">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="file">
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">contact</label>

                            <div class="col-md-6">
                                <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{$user->contact}}" required autocomplete="contact">

                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hotel_id" class="col-md-4 col-form-label text-md-right">dest</label>

                            <div class="col-md-6">
                                <select name="dest_id" class="form-control">
                                    <option disable selected>--choice--</option>
                                    @forelse($dests as $d)
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                    @empty
                                    <option disable selected>empty</option>
                                    @endforelse
                                </select>   

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hotel_id" class="col-md-4 col-form-label text-md-right">hotel</label>

                            <div class="col-md-6">
                                <select name="hotel_id" class="form-control">
                                    <option disable selected>--choice--</option>
                                    @forelse($hotels as $h)
                                    <option value="{{$h->id}}">{{$h->name}}</option>
                                    @empty
                                    <option disable selected>empty</option>
                                    @endforelse
                                </select>   

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    register
                                </button>
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