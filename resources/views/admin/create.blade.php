@extends('layouts.app')
@section('header')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
                    <form method="POST" action="{{ route('admin.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label ">name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label ">email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-12 col-form-label ">contact</label>

                            <div class="col-md-6">
                                <input id="contact" type="number" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact">

                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dest_id" class="col-md-12 col-form-label ">dest</label>

                            <div class="col-md-6">
                                <select name="dest_id" class="form-control @error('dest_id') is-invalid @enderror">
                                    <option>--choice--</option>
                                    @forelse($dests as $d)
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                    @empty
                                    <option disabled selected>empty</option>
                                    @endforelse
                                </select>   

                                <!-- @error('dest_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hotel_id" class="col-md-12 col-form-label ">hotel</label>

                            <div class="col-md-6">
                                <select name="hotel_id" class="form-control @error('hotel_id') is-invalid @enderror">
                                    <option>--choice--</option>
                                    @forelse($hotels as $h)
                                    <option value="{{$h->id}}">{{$h->name}}</option>
                                    @empty
                                    <option disabled selected>empty</option>
                                    @endforelse
                                </select>   

                                <!-- @error('hotel_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label ">password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 col-form-label ">password confirm</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
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