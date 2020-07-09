var map;
var myLatLng;
// Kec. Banguntapan, Bantul, Daerah Istimewa Yogyakarta
// -7.836223, 110.424235
$(document).ready(function() {
    //success();
    geoLocationInit();
    
}); 

    function geoLocationInit() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(success, fail);
        } else {
            alert("Browser not supported");
        }
    }

    function success(position) {
        //demang
        // var latval =-7.887598;
        // var lngval =110.011231;
        // ketawang
        // var latval = -7.845996;
        // var lngval = 109.886193;
        // atimalag
        // var latval = -7.879339;
        // var lngval = 109.983191;
        // kalil
        // var latval = -7.7520003;
        // var lngval = 110.117021
        //ketawang
        // var latval = -7.772898;
        // var lngval = 110.111090;
        console.log(position);
        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;
        myLatLng = new google.maps.LatLng(latval, lngval);
        createMap();
        search();
    }

    function fail() {
        alert("it fails");
    }

    function createMap() {
        var latval =-7.662063;
        var lngval =110.037338;
        myLatLng = new google.maps.LatLng(latval, lngval);
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 10    
        });
        // var marker = new google.maps.Marker({
        //     position: myLatLng,
        //     map: map
        // });
    }
    //Create marker
    function createMarker(latlng, icn, name) {
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: icn,
            title: name
        });
    }
    function search(){
        $.get('http://localhost:8000/api/dest',function(match){
            console.log(match);
            $.each(match,function(i,val){
                var glatval=val.lat;
                var glngval=val.lng;
                var gname=val.name;
                console.log(val.name);
                var GLatLng = new google.maps.LatLng(glatval, glngval);
                var gicn= 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                createMarker(GLatLng,gicn,gname);
            });

            //   $.each(match, function(i, val) {
            //     console.log(val.name);
            //   });
        });
    
    }