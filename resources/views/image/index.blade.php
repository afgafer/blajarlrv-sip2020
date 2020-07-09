@extends('layouts.app')
@section('content')
<h1 class="title">images</h1>
<hr>
<!-- alert -->
@if ($msg = Session::get('msg'))
 <div class="alert alert-success martop-sm">
 <p>{{ $msg }}</p>
 </div>
@endif
<!--end alert -->
<!-- <a href="{{route('image.create')}}" class="btn btn-primary">create/confirm</a> -->
<a href="{{route('image.create')}}" class="btn btn-primary">create</a>
<div class="card-columns">
            @forelse($images as $i)
            @php
            $dirF='upload/img/'.$i->file;
            $src=asset($dirF);
            @endphp
            <div class="box card">
                <a class="text-white" href="{{route('image.show',$i->id)}}">
                <img src="{{$src}}" class="card-img-top border border-secondary" alt="{{$i->file}}">
                <div class="overlay text-left">
                    <div class="btn-group">
                        <a href="{{route('image.edit',$i->id)}}" class="btn btn-primary btn-sm mr-1">edit</a>
                        <form action="{{route('image.destroy',$i->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-danger btn-sm mr-1" type="submit">delete</button>
                        </form>
                    </div>
                </div>
                </a>
            </div>
            @empty
            <div class="card p-0">
                <div class="card-body">
                    <h5>empty</h5>
                </div>
            </div>
            @endforelse
</div>
@endsection