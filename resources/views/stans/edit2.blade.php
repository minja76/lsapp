

@extends('layouts.app')
@section('content')
 <div class="row">

 <div class="col-md-8 col-sm-8">

{!! Form::open(['action' => ['StansController@update', $stan->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

<div class="form-group">
    {{ Form::label('grad', 'Grad:') }}
    {{ Form::text('grad', $stan->grad, ['class' =>  'form-control', 'placeholder'=>'Grad']) }}
</div>

<div class="form-group">
    {{ Form::label('ulica', 'Ulica:') }}
    {{ Form::text('ulica', $stan->ulica, ['class' =>  'form-control', 'placeholder'=>'Ulica']) }}
</div>


<div class="form-group">
    {{ Form::label('broj', 'Broj:') }}
    {{ Form::text('broj',  $stan->broj, ['class' =>  'form-control', 'placeholder'=>'Broj']) }}
</div>

<div class="form-group">
    {{ Form::label('km', 'Kvadratura:') }}
    {{ Form::text('km',  $stan->km, ['class' =>  'form-control', 'placeholder'=>'Kvadratura']) }}
</div>


<div class="form-group">
    {{ Form::label('cena', 'Cena:') }}
    {{ Form::text('cena',  $stan->cena, ['class' =>  'form-control', 'placeholder'=>'Cena']) }}
</div>

<div class="form-group">
    {{ Form::label('opis', 'Opis:') }}
    {{ Form::textarea('opis', $stan->opis, ['id'=>'article-ckeditor','class' =>  'form-control', 'placeholder'=>'Opis']) }}
</div>



<div class="form-group">
    {{ Form::file('cover_image') }}
   
</div>

 {{ Form::hidden('_method', 'PUT') }}
    {{ Form::submit('Submit', ['class' =>  'btn btn-primary']) }}

    {!! Form::close() !!}

 

    </div>

<div class="col-md-4 col-sm-4">
                                
           <img style="width:80%" "height:80%" src="/storage/stanovi/{{$stan->cover_image}}">
      </div>
  

         </div>
    
 @endsection('content')