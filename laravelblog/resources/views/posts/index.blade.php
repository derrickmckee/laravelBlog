@extends('layouts.app')
@section('content')

<h3>Most Recent Posts</h3>
@if(count($posts) > 0)
	
	@foreach($posts as $post)
	<div class="row">
		<div class="col-md-4">
			<img src="/storage/cover_img/{{$post->cover_img}}" class="card-img" alt='' >
		</div>
		<div class='col-md-8'>
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">
						<a href="/posts/{{$post->id}}">{{$post->title}}</a>
					</h5>
					<p class='card-text'>{{$post->created_at}}</p>
				</div>
			</div>
		</div>
	</div>

	
		
	@endforeach
@else

@endif


@endsection