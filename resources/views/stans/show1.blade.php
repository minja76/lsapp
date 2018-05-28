
@extends('layouts.app')
@section('content')
    
<link href="{{ URL::asset('css/box.css') }}" rel="stylesheet">

<style type="text/css">

     

    #map {
     height: 300px;
     width: 300px;
            }

         
 img {
    border-radius: 5px;
    padding: 0px;
    width: 300px;
    object-fit: cover;
}  

.small{
    border-radius: 5px;
    /* border-radius: 10px; */
    padding: 0px;
    width: 100px;
    object-fit: cover;
    transition: 0.3s;

}

/* Style the Image Used to Trigger the Modal */
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption { 
    animation-name: zoom;
    animation-duration: 0.6s;
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
  
 </style>

<div class='container'>

   <a class='btn btn-default' href='/stans'>Povratak na pregled</a>
    
     
     <h3>Adresa: {{$stan->mesto['naziv']}}, {{$stan->naselje['naziv']}}, {{$stan->adresa['naziv']}}, {{$stan->broj}}</h3>
     
 <div class="row">
    <div class="col-sm-6">           
        <img  id="myImg" src="/storage/stanovi/{{$stan->cover_image}}">           
    </div>    
    <div class="col-sm-6">            
                
            @foreach($stan->photos as $index=>$file)          
                  
            <img id="myImg<?php echo $index ?>" class="small" src="/storage/photos/{{$file->stan_id}}/{{$file->photo}}" width="300" onclick="showImage(this,<?php echo $index ?>)">
                       
                @endforeach   
              
     </div>    
     
    </div> 

   


                
                    
                         <!-- The Modal -->
                            <div id="myModal" class="modal">
                                
                                <!-- The Close Button -->
                                <span class="close">&times;</span>
                                
                                <!-- Modal Content (The Image) -->
                                <img class="modal-content" id="img01">
                                
                                <!-- Modal Caption (Image Text) -->
                                <div id="caption"></div>
                           </div>
                                                        
    </div>  
        
    <!-- CAROUSEL -->

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
                @foreach($stan->photos as $index=>$file)     
          <div class="carousel-item active">
            <img class="d-block w-100" src="/storage/photos/{{$file->stan_id}}/{{$file->photo}}" alt="First slide">
          </div>
          @endforeach        
         
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


          <!-- CAROUSEL END -->
           
           
<div class="row">
     
            <div class="col-md-8 col-sm-8">
            <h4><b>Opis:</b>{!!$stan->opis!!}</h4>
            </div>
            <div class="tags">
                @foreach($stan->karakters as $karakter)
                <span class="label label-default">{{$karakter->name}}</span>
                @endforeach
                </div>
    </div>
     <hr> 
     <hr>

    @if(!Auth::guest())    
    @if(Auth::user()->id==$stan->user_id)
    <a class='btn btn-default' href='/stans/{{$stan->id}}/edit'> Edit</a>

    {!! Form::open(['action' => ['StansController@destroy', $stan->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
    {{ Form::hidden('_method', 'DELETE') }}
    {{ Form::submit('Delete', ['class' =>  'btn btn-danger']) }}
    {!! Form::close() !!}
     @endif   
     @endif  
        
     <hr>
    
  
     
     
         <div class="row">
         <div id="map" class="center"></div>
         </div>
  
    



        <div class="slideshow-container">
            @foreach($stan->photos as $photo)      
            <div class="mySlides fade">             
              <img src="/storage/photos/{{$photo->stan_id}}/{{$photo->photo}}" style="width:100%">
             </div>
             @endforeach   
           
             
      
       
                          
            
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            
            </div>
       
        <script>



$('.carousel').carousel()

           function initMap() {
                  var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: {lat: {{$stan->lat}}, lng: {{$stan->lng}}},
                    gestureHandling: 'greedy'
                  });
            
     
                  var marker = new google.maps.Marker({
                                        map: map,
                                        animation: google.maps.Animation.DROP,
                                        position: {lat: {{$stan->lat}}, lng: {{$stan->lng}}}
                                      });        
              

 
               } 

                                    // Get the modal
                        var modal = document.getElementById('myModal');

                        // Get the image and insert it inside the modal - use its "alt" text as a caption
                        var img = document.getElementById('myImg');
                        var modalImg = document.getElementById("img01");
                        var captionText = document.getElementById("caption");
                        img.onclick = function(){
                            modal.style.display = "block";
                            modalImg.src = this.src;
                            captionText.innerHTML = this.alt;
                        }

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() { 
                        modal.style.display = "none";
                        }


                                                        function showImage(element,i){
                                    // Get the modal
                                    var modal = document.getElementById('myModal');

                                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                                    var img = document.getElementById('myImg'+i);
                                    var modalImg = document.getElementById("img01");
                                    var captionText = document.getElementById("caption");
                                        modal.style.display = "block";
                                        modalImg.src = element.src;
                                        captionText.innerHTML = element.alt;
                                }
     
         </script>
<link href="{{ URL::asset('js/box.js') }}" rel="script">
         <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsO9vSBB87bJ18ham6-RMgOrQc1AnkBpw&callback=initMap"></script>
                 
     
       
      
 @endsection('content')

