
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
          zoom: 12,
         center: {lat: 43.322, lng: 21.944},
         gestureHandling: 'greedy'
       });
       

        var geocoder = new google.maps.Geocoder();       
 
            var city = 'Niš';
            var ulica = '{{$street->ulica}}';
            var broj = '{{$street->broj}}';
            var address1 = city + "," + ulica + " " + broj;    
            var image="/storage/images/home.png";   
            geocodeAddress(geocoder, map, address1, image);   


         @foreach($streets as $street1)
 
            var city = 'Niš';
            var ulica = '{{$street1->ulica}}';
            var broj = '{{$street1->broj}}';
            var address2 = city + "," + ulica + " " + broj;
            var idbroj={{$street1->id}};
       
            geocodeAddress1(geocoder, map, address2, idbroj);   

             
         @endforeach
                   
      }


                      function geocodeAddress(geocoder, resultsMap, address, image) {
                  
                          geocoder.geocode({'address': address}, function(results, status) {
                            if (status === 'OK') {
                              var pinImage = new google.maps.MarkerImage("http://www.googlemapsmarkers.com/v1/A/00FF00");
                             
                                var marker = new google.maps.Marker({
                                map: resultsMap,
                                icon:pinImage,
                                position: results[0].geometry.location
                              });
                                  


                            } else {
                              alert('Geocode was not successful for the following reason: ' + status);
                            }
                        
                           });

       
                           } 




                          function geocodeAddress1(geocoder, resultsMap, address, idbr) {
                  
                          geocoder.geocode({'address': address}, function(results, status) {
                            if (status === 'OK') {
                         
                              var marker{{$street1->id}} = new google.maps.Marker({
                                map: resultsMap,
                                position: results[0].geometry.location                              
                               
                              
                              });


                       var infoWindow{{$street1->id}}= new google.maps.InfoWindow({
                            content: '<a href="/show/' + idbr + '">' + address + '</a>',          
                            maxWidth: 250
                      });

    // Opens the InfoWindow when marker is clicked.
                          marker{{$street1->id}}.addListener('click', function() {
                          infoWindow{{$street1->id}}.open(map, marker{{$street1->id}});
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

      