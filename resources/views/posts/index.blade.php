@extends('layouts.app')

@section('content')
    <h3>Posts</h3>
    @if(count($posts)>0)
        @foreach ($posts as $post )
            <div class="card card-body pt-3 mt-3">
                <h3><a href="/laravel1/lapp/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
            </div>            
        @endforeach
        <!--pagination-->
        {{$posts->links()}}
    @else
        <p>No posts available<p>
    @endif
@endsection
