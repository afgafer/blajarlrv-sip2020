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
            $dirF='upload/img/'.$member->file;
            $src=asset($dirF);
            @endphp
                <img src="{{$src}}" class="card-img-top" alt="{{$member->file}}">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <form action="{{route('member.upload',$member->id)}}" method="post" enctype="multipart/form-data">
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
                                <td>: {{$member->name}}</td>
                            </tr>
                            <tr>
                                <td>email</td>
                                <td>: {{$member->email}}</td>
                            </tr>
                            <tr>
                                <td>contact</td>
                                <td>: {{$member->user->contact}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
            <!-- card -->
        </div>
        <!-- row -->
@endsection