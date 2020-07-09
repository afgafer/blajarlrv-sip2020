@extends('layouts.app')
@section('content')
<h1 class="title text-center">destination</h1>
<hr>
@if ($message = Session::get('message'))
<div class="alert alert-success martop-sm">
    <p>{{ $message }}</p>
</div>
@endif
<a href="{{route('dest.create')}}" class="btn btn-primary btn-sm">create</a>
<!-- card-columns -->
<div class="card-columns">
    @forelse($dests as $d)
    @php
    $dirF='upload/img/'.$d->file;
    $src=asset($dirF);
    @endphp
    <div class="card p-0">
        <a class="text-dark" href="{{route('dest.show',$d->id)}}">
            <img src="{{$src}}" class="card-img-top" alt="{{$d->file}}">
            <div class="card-body">
                <h5>{{$d->name}}</h5>
                <div>
                    <div class="btn-group">
                        <a href="{{route('dest.edit',$d->id)}}" class="btn btn-primary btn-sm mr-1">edit</a>
                        <form action="{{route('dest.destroy',$d->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @empty
    <div class="card">
        <div class="card-body">empty</div>
    </div>
    @endforelse
</div>
<!--end card-columns -->
@endsection