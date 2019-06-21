@extends('layouts.app')

@section('content')
    <h3>Edit Post</h3>
    {{ Form::open(['action' => ['PostsController@update', $posts->id], 'method' => 'POST']) }}
       <div class="form-group">
       {{Form::label('title', 'Title')}}
       {{Form::text('title', $posts->title, ['class'=>'form-control', 'placeholder'=> 'Title'])}}
       </div>
       <div class="form-group">
       {{Form::label('body', 'Body')}}
       {{Form::textarea('body', $posts->body, ['id' => 'article-ckeditor','class'=>'form-control', 'placeholder'=> 'Body Text'])}}
       </div>
       {{Form::hidden('_method', 'PUT')}}
       {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {{ Form::close() }}
@endsection
