@extends('layouts.app')
@section('content')

<h3>Unesi dodatne slike</h3>

{!! Form::open(['action' => 'PhotosController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data', 'file'=>true]) !!}
{{Form::hidden('stan_id', $stan_id)}}
<div class="form-group">
{{Form::file('files[]', ['multiple'=>'multiple'])}}
</div>
<div class="form-group">
{{ Form::submit('Sačuvajte', ['class' =>  'btn btn-primary']) }}
</div>
{!! Form::close() !!}



@endsection('content')