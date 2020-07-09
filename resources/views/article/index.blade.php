@extends('layouts.app')
@section('content')

<h1 class="title">articles</h1>
<hr>
@if ($message = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<a href="{{route('article.create')}}" class="btn btn-primary btn-sm">create</a>
<div class="card-columns">
            @forelse($articles as $a)
            @php
            $dirF='upload/img/'.$a->file;
            $src=asset($dirF);
            $time=date_create($a->created_at);
            $date=date_format($time,'d-m-Y');
            $content=substr($a->content,0,500);
            @endphp
            <div class="card p-0">
                <a class="text-dark" href="{{route('article.show',$a->id)}}">
                <img src="{{$src}}" class="card-img-top" alt="{{$a->file}}">
                <div class="card-body">
                    <h5>{{$a->title}}</h5>
                    <div>
                        <span class="badge badge-primary">{{$a->admin->name}}</span><span class="badge badge-secondary">{{$date}}</span>
                    </div>
                    <div>
                        <?=$content?>
                        ...
                    </div>
                    <div class="btn-group">
                        <a href="{{route('article.edit',$a->id)}}" class="btn btn-primary btn-sm mr-1">edit</a>
                        <form action="{{route('article.destroy',$a->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-danger btn-sm mr-1" type="submit">delete</button>
                        </form>
                        <a href="{{route('article.showA',$a->id)}}" class="btn btn-light btn-outline-primary btn-sm">read more >></a>
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