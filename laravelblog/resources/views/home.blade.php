@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                
                <div class="card-body">
                    <a href='/posts/create' class='btn btn-primary btn-block'>Create Post</a>
                </div>
            </div> <!-- end dashboard card -->
        </div>
    </div> <!-- end row -->

    <br>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(count($posts) > 0)

                @foreach($posts as $post)
                <div class='card mb-3'>
                    <div class="row no-gutters">
                        <div class="col-md-8">
                            <h5 class='card-title'>
                                     <a href="/posts/{{$post->id}}/">
                                    {{$post->title}}
                                </a>
                            </h5>
                            <small class='card-text'>{{$post->created_at}}</small>
                           
                        </div>
                        <div class="col-md-4">
                            <img src="/storage/cover_img/{{$post->cover_img}}" class="card-img" alt='' >
                        </div>
                    </div>
                </div>
                <br><br>
                @endforeach
            @else
                <h5>No Posts</h5>
            @endif           
        </div>
    </div> <!-- end row -->
</div><!-- end container -->
@endsection
