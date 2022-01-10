@extends('layouts.app')

@section('content')
    <h1>Edit a Post</h1>
    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update',$post->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
       <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
       </div>
       <br>
       <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body',$post->body,['class'=>'form-control','placeholder'=>'Body'])}}
       </div>
       <br>
       <div>
            {{Form::file('cover_image')}}
       </div>
       <br>
       {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection