@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
@endsection

@section('content')
<h1 class="title " id="name">{{$dest->name}}</h1>
<hr>
        <div class="row p-2 justify-content-center">
            <div class="card p-0 col-md-6">
            @php
            $dirF='upload/img/'.$dest->file;
            $src=asset($dirF);
            @endphp
                <img src="{{$src}}" class="card-img-top" alt="{{$dest->file}}">
                <div class="card-body">
                    <table class="table table-sm mb-2">
                        <tbody>
                            <tr>
                                <td>contact</td>
                                <td>: {{$dest->contact}}</td>
                            </tr>
                            <tr>
                                <td>lat :</td>
                                <td id="lat">{{$dest->lat}}</td>
                            </tr>
                            <tr>
                                <td>lng :</td>
                                <td id="lng">{{$dest->lng}}</td>
                            </tr>
                            <tr>
                                <td>address</td>
                                <td>: {{$dest->address}} </td>
                            </tr>
                            <tr>
                                <td>address</td>
                                <td>: {{$dest->address}} </td>
                            </tr>
                        </tbody>
                    </table>
                    <h4 class="card-title">desc :</h4>
                    <?=$dest->desc?>
                </div>
                <div class="card-footer">
                </div>
            </div>
            <div class="card p-0 col-md-5 bg-transparent m-2">
            <div id="map" style="width:100%;height:75vh;"></div>
                <div class="card-body">
                <h5 class="card-title">hotel list</h5>
                    <table class="table table-sm mb-2">
                        <tbody>
                            @forelse($hotels as $h)
                                @php                            
                                $dirF='upload/img/'.$h->file;
                                $src=asset($dirF);
                                @endphp
                            <tr>
                                <td>-</td>
                                <td>
                                    <img src="{{$src}}" alt="{{$h->file}}" class="img-thumbnail img-s">
                                    {{$h->name}}
                                </td>
                                <td>{{$h->contact}}</td>
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
            L.latLng({{$dest->lat}}, {{$dest->lng}})
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