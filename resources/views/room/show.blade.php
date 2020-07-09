@extends('layouts.app')
@section('content')
            <div class="card p-0 col-md-6">
            <?php
            $src='/upload/img/'.$room->file;
            ?>
                <img src="{{$src}}" class="card-img-top" alt="{{$room->image}}">
                <div class="card-body">
                    <h2 class="card-title text-white badge badge-primary">No {{$room->id}}</h2>
                    <h2 class="card-title border badge badge-light">Rp {{$room->price}}</h2>
                    <table class="table table-sm mb-2">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>: {{$room->name}}</td>
                            </tr>
                            <tr>
                                <td>cap</td>
                                <td>: {{$room->cap}}</td>
                            </tr>
                            <tr>
                                <td>hotel</td>
                                <td>: {{$room->hotel->name}}</td>
                            </tr>
                            <tr>
                                <td>slot</td>
                                <td>: {{$room->slot}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h4 class="card-title">description :</h4>
                    <?=$room->desc?>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{route('room.roomshow',$room->id)}}">check</a>
                </div>
            </div>
 @endsection
