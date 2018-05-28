
@extends('layouts.app')
@section('content')
    <h1></h1>



    <style>
       #map {
        height: 400px;
        width: 500px;
        left:30%;
        position:absolute;
        margin:auto;
       }
    </style>
  </head>
  <body>
  <div class="container">
    <h3>Location</h3>
      <div class="row">
    <div id="map" class="center"></div>
    </div>
       </div>
  
    <script>
      function initMap() {
        var uluru = {lat: 43.31673217, lng: 21.89578414};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsO9vSBB87bJ18ham6-RMgOrQc1AnkBpw&callback=initMap">
    </script>

      
 @endsection('content')
