
@extends('layouts.app')
@section('content')

<style>
        
img {
    border-radius: 5px;
    padding: 0px;
    width: 300px;
    object-fit: cover;
}  

</style>

<div class="row">
    <h1>Stanovi</h1> <a class='btn btn-default float:right' href='/mapa'>Pogledaj mapu stanova</a>
   
<div/>
   @if (count($stans)>0)
   @foreach($stans as $stan)
    
             <div class="row">
                    <div class="col-md-8 col-sm-8">
                    <h2>Opis nekretnine</h2>   
                    <h3><b>Adresa:</b> {{$stan->mesto['naziv']}}, {{$stan->naselje['naziv']}},{{$stan->adresa['naziv']}}, {{$stan->broj}}</h3>                                 
                    <h3><a href='/stans/{{$stan->id}}'> <img src="/storage/stanovi/{{$stan->cover_image}}"></a></h3> 
                    </div>
                    <div class="col-md-4 col-sm-4">  
                           <div id="map">
                          </div>                               
                    </div>
              </div>                
                                
 

@endforeach

    {{$stans->links()}}
    @else
     <h1>Nema stanova u ponudi</h1>
     @endif

@endsection('content')
