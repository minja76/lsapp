
@extends('layouts.app')
@section('content')
    

<style type="text/css">
  

     

    #map {
     height: 300px;
     width: 300px;
            }

/*            
            .holder img {
              max-height: 300px;
              max-width: 300px;
              object-fit: cover;
            } */

            img {
                border-radius: 5px;
                padding: 0px;
                width: 300px;
                object-fit: cover;
            }  

.small{
    border: 2px solid #000;
    /* border-radius: 10px; */
    padding: 0px;
    width: 100px;
    object-fit: cover;
}
  
 </style>

<div class='container'>

     <a class='btn btn-default' href='/stans'>Povratak na pregled</a>     
     
     <h3>Adresa: {{$stan->mesto['naziv']}}, {{$stan->naselje['naziv']}}, {{$stan->adresa['naziv']}}, {{$stan->broj}}</h3>
     
<div class="row">
    <div class="col-sm-6">           
        <img src="/storage/stanovi/{{$stan->cover_image}}">           
    </div>    

    <div class="col-sm-6">       
        <div id="map" class="center"></div>                                         
                           
    </div>  
</div>             
           
   <br>        
<div class="row">
     
            <div class="col-md-8 col-sm-8">
            <h4><b>Opis:</b>{!!$stan->opis!!}</h4>
            </div>
            <div class="col-md-4 col-sm-4">
            <div class="tags">
                @foreach($stan->karakters as $karakter)
                <span class="label label-default">{{$karakter->name}}</span>
                @endforeach
            </div>
            </div>
</div>

<br>  
<br>  

 
        
     <hr>
    
  
     {!! Form::open(['action' => ['StansController@latlng', $stan->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
     
     <div class="form-group">
         {{ Form::label('lat', 'lat:') }}
         {{ Form::text('lat', '', ['class' =>  'form-control', 'placeholder'=>'lat']) }}
     </div>
     
     <div class="form-group">
         {{ Form::label('lng', 'lng:') }}
         {{ Form::text('lng', '', ['class' =>  'form-control', 'placeholder'=>'lng']) }}
     </div>
     {{ Form::hidden('_method', 'PUT') }}
     {{ Form::submit('Natavite', ['class' =>  'btn btn-primary']) }}
 
     {!! Form::close() !!}
     
     
     

       
        <script>


           function initMap() {
                  var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: {lat: 43.363, lng: 22.044},
                    gestureHandling: 'greedy'
                  });
            
     
                 var geocoder = new google.maps.Geocoder();         
                     
                 
                 var grad = '{{$stan->mesto['naziv']}}';
                 var naselje = '{{$stan->naselje['naziv']}}';
                 var ulica = '{{$stan->adresa['naziv']}}';
                 var broj = '{{$stan->broj}}';
                 var address ='Srbija,'+ grad + " " + ulica + " " + broj;
               
                 
                 
                 geocodeAddress(geocoder, map, address);   
     
                                        
           }
     
                          
       
               function geocodeAddress(geocoder, resultsMap, address) {
                       
                               geocoder.geocode({'address': address}, function(results, status) {
                                

                                  resultsMap.setCenter(results[0].geometry.location);

                                  document.getElementById('lat').value = results[0].geometry.location.lat();
                                  document.getElementById('lng').value = results[0].geometry.location.lng(); 
                              
                                      var marker = new google.maps.Marker({
                                        map: resultsMap,
                                        animation: google.maps.Animation.DROP,
                                        position: results[0].geometry.location
                                      });                      
                                      
     
     
                                     var infoWindow= new google.maps.InfoWindow({
                                          content:address,            
                                          maxWidth: 250
                                      });
     
                            // Opens the InfoWindow when marker is clicked.
                                        marker.addListener('click', function() {
                                        infoWindow.open(map, marker);
                                    });
                                    
                                });
                 
        

 
               } 

               
     
         </script>
         <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsO9vSBB87bJ18ham6-RMgOrQc1AnkBpw&callback=initMap"></script>
                 
     
       
      
 @endsection('content')
