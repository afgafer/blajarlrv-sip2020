@extends('layouts.app')
@section('content')
            <h1 class="title">Image</h1>
            <hr>
            <form action="{{route('image.update',$image->id)}}" method='post' enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('put')}}
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="name">name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$image->name}}" >
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @php
            $dirF='upload/img/'.$image->file;
            $src=asset($dirF);
            @endphp
                <div class="form-group">
                    <div class="col-md-6">
                        <img src="{{$src}}" class="img-thumbnail img-m @error('name') is-invalid @enderror" alt="{{$image->file}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" >
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="col-md-4">
                        <label for="dest">dest</label>
                        <select name="dest_id" class="form-control @error('dest_id') is-invalid @enderror">
                            <option disabled selected>--Pilih--</option>
                            @php
                            $dests=\App\models\Dest::orderBy('name','ASC')->get();
                            @endphp
                            @forelse($dests as $d)
                            <option {{$d->id==$image->dest_id? 'selected="selected"' : ''}} value="{{$d->id}}">{{$d->name}}</option>
                            @empty
                            <option disabled selected>empty</option>
                            @endforelse
                        </select>
                        @error('dest_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="col-12">
                        <label for="desc">Deskripsi</label>
                        <textarea class="form-control @error('desc') is-invalid @enderror" required="" name="desc">{{$image->desc}}</textarea>
                        @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">save</button>
            </form>
 @endsection