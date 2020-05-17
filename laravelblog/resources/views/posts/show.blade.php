@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
	<div class='col-md-8'>
		<div class='row'>
			<div class='col'>
				<h2 class="card-title">{{$post->title}}</h2>
				
				<img src="/storage/cover_img/{{$post->cover_img}}" class="" alt="" style="width:100%; height:auto;">	
			</div>
		</div> 		
        <div class="row">
			<div class='col'>
	        	<div class="card">	        		
	        		<p class="card-text">{{$post->body}}</p>  
	        		<hr>      	
					<div class='card-footer text-muted'>
						<small>Written on {{$post->created_at}}</small>
					</div>
				</div>
			</div>
        </div>
	</div>









	{{-- EDIT/DEL///IF_LOGGED_IN_OWNER///////////////////////////////////////// --}}
	@if(!Auth::guest())
		@if(Auth::user()->id == $post->user_id )
		<div class="col-md-3">
		    
			<a href="/posts/{{$post->id}}/edit" class="btn btn-primary btn-block">Edit</a>
		</div>
		<div class='col-md-1'>
				{!!Form::open(
					['action'=> ['PostsController@destroy', $post->id], 
					'method'=> 'POST', 
					'class' => 'pull-right'])
				!!}
				{{Form::hidden('_method', 'DELETE')}}
				{{Form::submit('X',['class'=>'btn btn-danger btn-block'])}}
				{!!Form::close()!!}
		</div>
		@endif
	@endif
	{{-- ////////////////////////////////////////////////////////////////// --}}

</div>	<!-- endrow -->
@endsection
