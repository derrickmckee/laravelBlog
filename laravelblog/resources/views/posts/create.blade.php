@extends('layouts.app')

@section('content')
<h1>Create Post</h1>
{!! Form::open(['action' => 'PostsController@store', 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
<div class="form-group">
	{{Form::label('title', 'Title')}}
	{{FORM::text('title', '', ['class'=> 'form-control', 'placeholder'=>'Enter Title'])}}
</div>
<div class="form-group">
	{{Form::label('body', 'Body')}}
	{{FORM::text('body', '', ['class'=> 'form-control', 'placeholder'=>'Enter Body'])}}
</div>

<div class="form-group">	
{{Form::file('cover_img')}}
</div>

{{Form::submit('Submit',['class'=>'btn btn-primary'])}}



{!! Form::close() !!}

@endsection