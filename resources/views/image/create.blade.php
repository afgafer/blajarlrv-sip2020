@extends('layouts.app')
@section('content')
<h1 class="title">image</h1>
<hr>
<form action="{{route('image.store')}}" method='post' enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
        <div class="col-md-6 mb-3">
            <label for="name">name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 mb-3">
            <label for="file">image</label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" required>
            @error('file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>
    </div>
    <!-- <div class="form-group">
                    <div class="col-md-6 mb-3">
                        <label for="dest">dest</label>
                        <select name="dest_id" class="form-control @error('dest_id') is-invalid @enderror">
                            <option disabled selected required>--choice--</option>
                            @forelse($dests as $d)
                            <option value="{{$d->id}}">{{$d->name}}</option>
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
        <div class="col-12 mb-3">
            <label for="desc">desc</label>
            <textarea class="form-control @error('desc') is-invalid @enderror" required="" name="desc"></textarea>
            @error('desc')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>
    </div>
    <button class="btn btn-primary" type="submit">save</button>
</form>
<!-- <table class="table table-striped table-light table-sm">
    <thead>
        <tr class='bg-primary text-white'>
            <th>No</th>
            <th>name</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($images as $i)
        @php
        $dirF='upload/img/'.$i->file;
        $src=asset($dirF);
        @endphp
        <tr class=''>
            <td>{{$loop->iteration}}</td>
            <td><img src="{{$src}}" class="img-thumbnail img-m" alt="{{$i->file}}"> {{$i->name}}</td>
            <td>
                <form action="{{route('image.pConfirm',$i->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <select name="status" class="form-control" onchange="this.form.submit()">
                        <option disabled selected>--Confirm--</option>
                        <option value="1">accept</option>
                        <option value="2">abort</option>
                    </select>
                </form>
            </td>
        </tr>
        @empty
        <td colspan="4" class="text-center">empty</td>
        @endforelse
    </tbody>
</table> -->
@endsection