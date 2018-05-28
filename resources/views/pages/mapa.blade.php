
@extends('layouts.app')
@section('content')
    <h1></h1>



    <style>
       #map {
        height: 800px;
        width: 1000px;
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
      var uluru = {lat: 43.363, lng: 22.044};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: uluru
      });


      @foreach($stans as $stan)


      var marker{{$stan->id}} = new google.maps.Marker({
        position: {lat: {{$stan->lat}}, lng: {{$stan->lng}}},
        map: map
      });

      var grad = '{{$stan->mesto['naziv']}}';
            var naselje = '{{$stan->naselje['naziv']}}';
            var adresa = '{{$stan->adresa['naziv']}}';
            var broj = '{{$stan->broj}}';
            var address{{$stan->id}} = grad + "," + naselje + ", " + adresa + " " + broj;
            var idbr={{$stan->id}}

      var infoWindow{{$stan->id}}= new google.maps.InfoWindow({
      content: '<a href="/stans/' + idbr + '"' + 'target="_blank">' + address{{$stan->id}} + '</a>',                 
      maxWidth: 250
  });

  // Opens the InfoWindow when marker is clicked.
      marker{{$stan->id}}.addListener('click', function() {
      infoWindow{{$stan->id}}.open(map, marker{{$stan->id}});
  });



      @endforeach
    }
 
  </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsO9vSBB87bJ18ham6-RMgOrQc1AnkBpw&callback=initMap">
    </script>
    
  </body>
      
 @endsection('content')


