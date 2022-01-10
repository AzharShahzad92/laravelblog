@extends('layouts.app')

@section('content')
 <div class="container">
     <p><b>TRENDING &nbsp > &nbsp</b>{{$post->title}}</p>
      <h4>{{$post->title}}</h4>
         <img class="img-fluid mb-3" style="width: 50%; height:100%;" src="/storage/cover_images/{{$post->cover_image}}" alt="Post Image">
         
         <p>{{$post->body}}</p>
      <hr>
      <small>Created at: {{$post->created_at}}</small>
      <br>
      @if (Auth::user())
         @if (Auth::user()->id===$post->user_id)
            <a class="btn btn-primary" href="/posts/{{$post->id}}/edit">Edit</a>
            {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy',$post->id],'method'=>'DELETE', 'class'=>'d-inline']) !!}
            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
            {!! Form::close() !!} 
         @endif     
      @endif

  </div> 
@endsection