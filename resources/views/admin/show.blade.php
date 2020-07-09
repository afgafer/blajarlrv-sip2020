@extends('layouts.app')
@section('content')
@if ($msg = Session::get('msg'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
        <div class="row p-2">
            <!-- card -->
            <div class="card p-0 col-md-6">
            @php
            $dirF='upload/img/'.$admin->file;
            $src=asset($dirF);
            @endphp
                <img src="{{$src}}" class="card-img-top" alt="{{$admin->file}}">
                <div class="card-body">
                    <form action="{{route('admin.upload',$admin->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="file" class="form-control  @error('file') is-invalid @enderror" name="file">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    upload
                                </button>
                        </div>
                    </form>
                    <table class="table table-sm bg-white mb-2">
                        <tbody>
                            <tr>
                                <td>name</td>
                                <td>: {{$admin->name}}</td>
                            </tr>
                            <tr>
                                <td>email</td>
                                <td>: {{$admin->email}}</td>
                            </tr>
                            <tr>
                                <td>contact</td>
                                <td>: {{$admin->user->contact}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <!-- <small class="text-muted"><a class="btn btn-primary" href="{{route('dest.edit',$admin->id)}}">edit</a></small> -->
                </div>
            </div>
            <!-- card -->
        </div>
        <!-- row -->
        <a href="{{route('admin.index')}}" class="btn btn-primary">admins</a><a href="{{route('admin.edit',Auth::user()->id)}}" class="btn btn-primary">edit</a>
@endsection