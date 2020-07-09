@extends('layouts.app')
@section('content')

@if ($message = Session::get('message'))
 <div class="alert alert-success martop-sm">
 <p>{{ $message }}</p>
 </div>
@endif
<h1 class="text-center">users</h1>
<a href="{{route('user.create')}}" class="btn btn-primary btn-sm">create</a>
    <table class="table table-sm bg-white mb-2 ">
        <tbody>
            <tr class="bg-primary text-white">
                <th>no</th>
                <th>username</th>
                <th>email</th>
                <th>contact</th>
                <th>type</th>
                <th></th>
            </tr>
            @forelse($users as $u)
            @php
            $dirF='upload/img/'.$u->file;
            $src=asset($dirF);
            //$time=date_create($u->created_at);
            //$date=date_format($time,'d-m-Y');
            //$content=substr($u->content,0,500);
            if($u->type==1){
                $type='admin';
            }else{
                $type='user';
            }
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <img src="{{$src}}" alt="{{$u->file}}" class="img-thumbnail">
                    <a href="{{route('user.show',$u->id)}}">{{$u->name}}</a>
                </td>
                <td>{{$u->email}}</td>
                <td>{{$u->contact}}</td>
                <td>{{$type}}</td>
                <td>
                    <a href="{{route('user.edit',$u->id)}}" class="btn btn-primary btn-sm">edit</a>
                    <form action="{{route('user.destroy',$u->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">empty</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection