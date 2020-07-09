@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
@endsection
@section('content')
<div id="map" style="width:100%;height:500px;left:0;top:0;"></div>
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
    L.marker([e.latitude, e.longitude]).addTo(map).bindPopup("Your location");
    @forelse($hotels as $h)
    @php                            
        $dirF='upload/img/'.$h->file;
        $src=asset($dirF);
    @endphp
        L.marker([{{$h->lat}}, {{$h->lng}}]).addTo(map).bindPopup("<img src='{{$src}}' alt='{{$h->file}}' class='img-thumbnail img-s'><a href='{{route('hotel.showA', $h->id)}}'>{{$h->name}}</a>");
    @empty
    L.marker([e.latitude, e.longitude]).addTo(map).bindPopup("Your location");
    alert('empty');
    @endforelse
}
function onLocationError(e) {
		alert(e.message);
}

	map.on('locationfound', onLocationFound);
	map.on('locationerror', onLocationError);

	map.locate({setView: true, maxZoom: 16});
</script>
@endsection