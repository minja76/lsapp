
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
 


               @foreach($stans as $stan)
              


            var grad = '{{$stan->mesto['naziv']}}';
            var naselje = '{{$stan->naselje['naziv']}}';
            var adresa = '{{$stan->adresa['naziv']}}';
            var broj = '{{$stan->broj}}';
            var address{{$stan->id}} = grad + "," + naselje + ", " + adresa + " " + broj;
            var idbroj = {{$stan->id}};

       
            geocodeAddress1(geocoder, map, address{{$stan->id}}, idbroj);   

             
              @endforeach
                   
      }


                   


                   function geocodeAddress1(geocoder, resultsMap, address, idbr) {
              
                        geocoder.geocode({'address': address}, function(results, status) {
                          if (status == google.maps.GeocoderStatus.OK) {

                       // Postavi marker  
        document.getElementById('lat').value = results[0].geometry.location.lat();
        document.getElementById('lng').value = results[0].geometry.location.lng(); 
                    
                                        var marker = new google.maps.Marker({
                                          map: resultsMap,
                                          animation: google.maps.Animation.DROP,
                                          position: results[0].geometry.location
                                        });
                                       
                        // Informacija koja se vidi na markeru 

                                        var infoWindow= new google.maps.InfoWindow({
                                        content: '<a href="/stans/' + idbr + '">' + address + '</a>',            
                                        maxWidth: 250
                                        });

                         // Opens the InfoWindow when marker is clicked.
                                        marker.addListener('click', function() {
                                        infoWindow.open(map, marker);
                                        });
                                          
                                      });
                       
              

       
                     } 

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsO9vSBB87bJ18ham6-RMgOrQc1AnkBpw&callback=initMap">
    </script>
    
    {!! Form::open(['action' => ['StansController@latlng', $stan->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
     
     <div class="form-group">
         {{ Form::label('lat', 'Lat:') }}
         {{ Form::text('lat', '', ['class' =>  'form-control', 'placeholder'=>'lat']) }}
     </div>
     
     <div class="form-group">
         {{ Form::label('lng', 'Ulica:') }}
         {{ Form::text('lng', '', ['class' =>  'form-control', 'placeholder'=>'lng']) }}
     </div>             
     
     
      {{ Form::hidden('_method', 'PUT') }}
         {{ Form::submit('Submit', ['class' =>  'btn btn-primary']) }}     
         {!! Form::close() !!}
     
      
 @endsection('content')
