@extends('layouts.app')

@section('content')
<a href="/laravel1/lapp/public/posts" class="btn btn-default">Go back</a>
    <h3>{{$posts->title}}</h3>
    <div>
    {{$posts->body}}
    </div>
    <hr>
    <small>Written on {{$posts->created_at}} by {{$posts->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if (Auth::user()->id==$posts->user_id)
            <a href="/laravel1/lapp/public/posts/{{$posts->id}}/edit" class="btn btn-default">Edit</a>
            {{Form::open(['action'=>['PostsController@destroy', $posts->id],'method'=>'POST', 'class'=>'pull-rightu'])}}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
            {{Form::close()}}
        @endif       
    @endif

@endsection
