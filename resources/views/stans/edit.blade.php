
@extends('layouts.app')
@section('content')


<div class="row">
        
         <div class="col-md-8 col-sm-8">

    {!! Form::open(['action' => ['StansController@update', $stan->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    
<div class="form-group">
    {{ Form::label('sifra_mesto', 'Mesto:') }}
   <select class="form-control" name="sifra_mesto" id="mesto">
        <option value="0" selected="true" disabled="true">{{$stan->mesto['naziv']}}</option>
   @foreach($mestos as $mesto)
   <option value="{{$mesto->id}}">{{$mesto->naziv}}</option>
   @endforeach
   </select>
</div>



<div class="form-group">
    {{ Form::label('sifra_naselje', 'Naselje:') }}
   <select class="form-control" name="sifra_naselje" id="naselje">
        <option value="0" selected="true" disabled="true">{{$stan->naselje['naziv']}}</option>
       
   </select>
</div>


<div class="form-group">
    {{ Form::label('sifra_adresa', 'Adresa:') }}
   <select class="form-control" name="sifra_adresa" id="adresa">
        <option value="0" selected="true" disabled="true">{{$stan->adresa['naziv']}}</option>
  
   </select>
</div>




<div class="form-group">
    {{ Form::label('broj', 'Broj:') }}
    {{ Form::text('broj', $stan->broj, ['class' =>  'form-control', 'placeholder'=>'Broj']) }}
</div>

<div class="form-group">
    {{ Form::label('km', 'Kvadratura:') }}
    {{ Form::text('km', $stan->km, ['class' =>  'form-control', 'placeholder'=>'Kvadratura']) }}
</div>


<div class="form-group">
    {{ Form::label('cena', 'Cena:') }}
    {{ Form::text('cena', $stan->cena, ['class' =>  'form-control', 'placeholder'=>'Cena']) }}
</div>

<div class="form-group">
    {{ Form::label('opis', 'Opis:') }}
    {{ Form::textarea('opis', $stan->opis, ['id'=>'article-ckeditor','class' =>  'form-control', 'placeholder'=>'Opis']) }}
</div>

<div class="row">
<div class="form-group">
        
            @foreach($karakters as $karakter)
            <div class="col-xs-6">
                <label>
                 <input type="checkbox" name="karakters[]" class="check" value="{{$karakter->id}}"/> {{$karakter->name}}
                </label>
            </div>
            @endforeach
</div>
</div>

<br>


<div class="row">
<div class="form-group">
    {{ Form::label('cover_image', 'Unesite glavnu sliku:') }}
    {{ Form::file('cover_image') }}   
</div>
</div>


<br>


<div class="row">

    {{ Form::submit('Nastavite', ['class' =>  'btn btn-primary']) }}

</div>
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
                            div.find('#naselje').html(" ");
                            div.find('#naselje').append(op);
                        
                             }
                      }
                  });
                });


                $('#naselje').on('change', function(){
                    
                          var sifra_naselje=$(this).val();
                          var div=$(this).parent().parent();
                          var op="";
                          $.ajax({
                              type: 'get',
                              url: '{{URL::to('stans/create_nas')}}',
                              data: {'sifra_naselje':sifra_naselje},
                              success:function(data){
                  
                                op+='<option value="0" selected="true" disabled="true">--Izaberi--</option>';
                                for(i=0;i<data.length;i++){
                                    op+='<option value="'+data[i].id+'">'+data[i].naziv+'</option>';
                                    div.find('#adresa').html(" ");
                                    div.find('#adresa').append(op);
                            
                                     }
                              }
                          });
                        });
        

                </script>
    
 @endsection('content')
