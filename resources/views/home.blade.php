@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
@endsection

@section('content')
<div class="bg-white p-2">
<h1 class="title " id="name">{{$hotel->name}}</h1>
<hr>
@auth
@if(Auth::user()->id==1)
@auth
@if(Auth::user()->id==1)
<a href="{{route('dest.create')}}" class="btn btn-primary" > create dest</a>
<a href="{{route('hotel.create')}}" class="btn btn-primary" > create hotel</a>
@endif
@endauth
@endauth
@endif
            <div class="row p-2 justify-content-center">
            <div class="card p-0 col-md-6 m-2 border-white">
            @php
            $dirF='upload/img/'.$hotel->file;
            $src=asset($dirF);
            @endphp
                <img src="{{$src}}" class="card-img-top" alt="{{$hotel->file}}">
                <div class="card-body">
                    <table class="table table-sm bg-white mb-2">
                        <tbody>
                            <tr>
                                <td>name</td>
                                <td>: {{$hotel->name}}</td>
                            </tr>
                            <tr>
                                <td>contact</td>
                                <td>: {{$hotel->contact}}</td>
                            </tr>
                            <tr>
                                <td>address</td>
                                <td>: {{$hotel->address}} </td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="card-title">description :</h5>
                    <p><?=$hotel->desc?></p>
                </div>
                <div class="card-footer">
                    <!-- <small class="text-muted"><a class="btn btn-primary" href="{{route('dest.edit',$hotel->id)}}">edit</a></small> -->
                </div>
            </div>
            <div class="card p-0 col-md-5 m-2  border-white">
            <div id="map" style="width:100%;height:75vh;"></div>
                <div class="card-body">
                <h5 class="card-title">room list</h5>
                    <table class="table table-sm mb-2">
                        <tbody>
                            @forelse($hotel->room as $r)
                            @php                            
                                $dirF='upload/img/'.$r->file;
                                $src=asset($dirF);
                            @endphp
                            <tr>
                                <td>-</td>
                                <td>
                                    <img src="{{$src}}" alt="{{$r->file}}" class="img-thumbnail img-s">
                                    {{$r->name}}
                                </td>
                                <td>{{$r->slot}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td>empty</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
</div>
 @endsection

 @section('script')
 <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script>
var map = L.map('map').fitWorld();;

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

function onLocationFound(e) {
    L.Routing.control({
        waypoints: [
            L.latLng(e.latitude, e.longitude),
            L.latLng({{$hotel->lat}}, {{$hotel->lng}})
        ],
        routeWhileDragging: true,
    }).addTo(map);
}
function onLocationError(e) {
		alert(e.message);
}

	map.on('locationfound', onLocationFound);
	map.on('locationerror', onLocationError);

	map.locate({setView: true, maxZoom: 16});
</script>
@endsection