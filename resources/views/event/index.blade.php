@extends('layouts.app')
@section('content')
<h1 class="title">events</h1>
<hr>
@if ($message = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<a href="{{route('event.create')}}" class="btn btn-primary btn-sm">create</a>
<div class="scroll">
    <table class="table table-sm bg-white mb-2 ">
        <tbody>
            <tr class="bg-primary text-white">
                <th>no</th>
                <th>name</th>
                <th>date</th>
                <th>place</th>
                <th></th>
            </tr>
            @forelse($events as $e)
            @php
            $dirF='upload/img/'.$e->file;
            $src=asset($dirF);
            $time=date_create($e->date);
            $date=date_format($time,'d-m-Y');
            $content=substr($e->content,0,500);
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('event.show',$e->id)}}">{{$e->name}}</a></td>
                <td>{{$date}}</td>
                <td>{{$e->place}}</td>
                <td>
                <div class="btn-group">
                    <a href="{{route('event.edit',$e->id)}}" class="btn btn-primary btn-sm mr-1">edit</a>
                    <form action="{{route('event.destroy',$e->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                    </form>
                </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">empty</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection