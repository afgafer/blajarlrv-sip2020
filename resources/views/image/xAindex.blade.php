@extends('layouts.app')
@section('content')
<div>
    <a href="{{route('image.create')}}" class='btn btn-secondary'>created</a>
</div>
<div class="card-columns">
            @forelse($images as $i)
            @php
            $dirF='upload/img/'.$i->file;;
            $src=asset($dirF);
            @endphp
            <div class="card">
                <a class="text-dark" href="{{route('image.edit',$i->id)}}">
                    <img src="{{$src}}" class="card-img-top" alt="{{$i->name}}">
                </a>
                <form action="{{route('image.destroy',$i->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('delete')}}
                <button type="submit">delete</button>
                </form>
                <form action="{{route('image.pConfirm',$i->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('put')}}
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option disabled selected>--Confirm--</option>
                    <option value="1">accept</option>
                    <option value="2">abort</option>
                </select>
                </form>
                <div class="card-body">
                    {{$i->desc}}
                </div>
            </div>
            @empty
            <h5>empty</h5>
            @endforelse
@endsection