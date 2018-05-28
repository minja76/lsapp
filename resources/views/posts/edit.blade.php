

@extends('layouts.app')
@section('content')
<div class="row">

<div class="col-md-8 col-sm-8">

{!! Form::open(['action' => ['PostsController@update', $post->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

<div class="form-group">
    {{ Form::label('title', 'Title:') }}
    {{ Form::text('title', $post->title, ['class' =>  'form-control', 'placeholder'=>'Title']) }}
</div>

<div class="form-group">
    {{ Form::label('body', 'Body:') }}
    {{ Form::textarea('body', $post->body, ['id'=>'article-ckeditor','class' =>  'form-control', 'placeholder'=>'Body']) }}
</div>

<div class="form-group">
    {{ Form::file('cover_image') }}
   
</div>

 {{ Form::hidden('_method', 'PUT') }}
    {{ Form::submit('Submit', ['class' =>  'btn btn-primary']) }}

    {!! Form::close() !!}


</div>

<div class="col-md-4 col-sm-4">                                
<img style="width:80%" "height:80%" src="/storage/cover_images/{{$post->cover_image}}">
</div>
 
</div>
    
 @endsection('content')