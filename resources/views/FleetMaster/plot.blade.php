<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        html, body { height: 100%; margin: 0; padding: 0; }
        #map { height: 100%; }
    </style>
</head>
<body>
<div id="map"></div>
<div id="lat" data-field-id="{{$lat}}"></div>
<div id="long" data-field-id="{{$long}}"></div>



<script type="text/javascript">

    function initMap() {
        var uluru = {lat: {{ $lat }} , lng: {{ $long }} };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: uluru
        });

        var contentString = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                {{--'<h1 id="firstHeading" class="firstHeading">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h1>'+--}}
                '<div id="bodyContent">'+
                '<h3> <b>Vehicle Number </b>: {{ $vehicleNumber }} </h3>'+
                '<p> <b>Location </b>: {{ $location }}  </p>'+
                '<p> <b>Speed </b>: {{ $speed }} </p>'+
                '</div>'+
                '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            title: 'Vehicle Info',
            icon : '{{ url('images/truck.png') }}',
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
        infowindow.open(map,marker);
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhxTGVGSDGIoS9dM1LAhPTj8FlNu78VhY&callback=initMap">
</script>
</body>
</html>