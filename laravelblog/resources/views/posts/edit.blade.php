@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
{!! Form::open(['action' => ['PostsController@update',$post->id] , 'method'=> 'POST', 'enctype'=> 'multipart/form-data']) !!}
<div class="form-group">
	{{Form::label('title', 'Title')}}
	{{FORM::text('title', $post->title, ['class'=> 'form-control','placeholder'=>'Enter Title'])}}
</div>
<div class="form-group">
	{{Form::label('body', 'Body')}}
	{{FORM::textArea('body', $post->body, ['class'=> 'form-control','placeholder'=>'Enter Body'] )}}
</div>

<div class="form-group">	
{{Form::file('cover_img')}}
</div>

{{Form::hidden('_method', 'PUT')}}
{{Form::submit('Submit',['class'=>'btn btn-primary'])}}



{!! Form::close() !!}

@endsection