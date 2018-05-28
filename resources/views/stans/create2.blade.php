
@extends('layouts.app')
@section('content')

{!! Form::open(['action' => 'StansController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

<div class="form-group">
    {{ Form::label('sifra_mesto', 'Mesto:') }}
   <select class="form-control" name="sifra_mesto" id="mesto">
        <option value="0" selected="true" disabled="true">--Izaberi--</option>
   @foreach($mestos as $mesto)
   <option value="{{$mesto->id}}">{{$mesto->naziv}}</option>
   @endforeach
   </select>
</div>


<div class="form-group">
    {{ Form::label('sifra_adresa', 'Adresa:') }}
   <select class="form-control" name="sifra_adresa" id="adresa">
        <option value="0" selected="true" disabled="true">--Izaberi--</option>
  
   </select>
</div>




<div class="form-group">
    {{ Form::label('grad', 'Grad:') }}
    {{ Form::text('grad', '', ['class' =>  'form-control', 'placeholder'=>'Grad']) }}
</div>

<div class="form-group">
    {{ Form::label('ulica', 'Ulica:') }}
    {{ Form::text('ulica', '', ['class' =>  'form-control', 'placeholder'=>'Ulica']) }}
</div>


<div class="form-group">
    {{ Form::label('broj', 'Broj:') }}
    {{ Form::text('broj', '', ['class' =>  'form-control', 'placeholder'=>'Broj']) }}
</div>

<div class="form-group">
    {{ Form::label('km', 'Kvadratura:') }}
    {{ Form::text('km', '', ['class' =>  'form-control', 'placeholder'=>'Kvadratura']) }}
</div>


<div class="form-group">
    {{ Form::label('cena', 'Cena:') }}
    {{ Form::text('cena', '', ['class' =>  'form-control', 'placeholder'=>'Cena']) }}
</div>

<div class="form-group">
    {{ Form::label('opis', 'Opis:') }}
    {{ Form::textarea('opis', '', ['id'=>'article-ckeditor','class' =>  'form-control', 'placeholder'=>'Opis']) }}
</div>

<div class="form-group">
    {{ Form::file('cover_image') }}
   
</div>

    {{ Form::submit('Submit', ['class' =>  'btn btn-primary']) }}

{!! Form::close() !!}


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">
    
    
        $('#mesto').on('change', function(){
            
                  var sifra_mesto=$(this).val();
                 var div=$(this).parent().parent();
                  var op="";
                  $.ajax({
                      type: 'get',
                      url: '{{URL::to('stans/create_adr')}}',
                      data: {'sifra_mesto':sifra_mesto},
                      success:function(data){
          
                       op+='<option value="0" selected="true" disabled="true">--Izaberi--</option>';
                       for(i=0;i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].naziv+'</option>';
                        div.find('#adresa').html(" ");
                        div.find('#adresa').append(op);
                     
                      }}
                  });
                });

                </script>
    
 @endsection('content')
