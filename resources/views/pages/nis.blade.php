
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
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 43.363, lng: 22.044},
          gestureHandling: 'greedy'
        });
       

        var geocoder = new google.maps.Geocoder();       
 


               @foreach($streets as $street1)
 
            var city = 'Niš';
            var ulica = '{{$street1->ulica}}';
            var broj = '{{$street1->broj}}';
            var address{{$street1->id}} = city + "," + ulica + " " + broj;
            var idbroj = {{$street1->id}};

       
        geocodeAddress1(geocoder, map, address{{$street1->id}}, idbroj);   

             
         @endforeach
                   
      }


                   


                   function geocodeAddress1(geocoder, resultsMap, address, idbr) {
                  
                        geocoder.geocode({'address': address}, function(results, status) {
                            if (status === 'OK') {
                         
                              var marker = new google.maps.Marker({
                                map: resultsMap,
                                animation: google.maps.Animation.DROP,
                                position: results[0].geometry.location
                              });


                                var infoWindow= new google.maps.InfoWindow({
                                content: '<a href="/show/' + idbr + '">' + address + '</a>',            
                                maxWidth: 250
                                 });

    // Opens the InfoWindow when marker is clicked.
                                marker.addListener('click', function() {
                                infoWindow.open(map, marker);
                                });
                                  
                                } else {
                               alert('Geocode was not successful for the following reason: ' + status);
                                }
                        
                           });

       
                     } 

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsO9vSBB87bJ18ham6-RMgOrQc1AnkBpw&callback=initMap">
    </script>
    

      
 @endsection('content')
