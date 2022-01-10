@extends('layouts.app')

@section('content')


        <div class="justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Dashboard') }}</h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        </div>
                        <br>
                        @if (count($posts) > 0)
                            @foreach ($posts as $post)
                               <div class="row">
                                   
                                        <div class="col-md-5" style="width: 325px; height:200px;">
                                            <a href="/posts/{{$post->id}}"> 
                                                <img class="card-img-top" style="width: 100%; height:100%;" src="/storage/cover_images/{{$post->cover_image}}" alt="Card image cap">
                                            </a>
                                        </div>
                                        <div class="card col-md-7">
                                           <div class="card-body">
                                                <h5><a href="/posts/{{$post->id}}"><b>{{$post->title}}</b></a></h5>
                                                <small class="text-muted">{{$post->user->name}} <b style="font-size: 30px;">&nbsp.&nbsp</b> {{$post->created_at->format('F d, Y')}}</small> 
                                                <p>{{substr($post->body,0,100)}}</p>
                                           </div> 
                                            
                                           <div class="card-footer" style="background-color:white;">
                                                <a class="btn btn-primary" style="bottom:0px;" href="/posts/{{$post->id}}/edit"><svg-icon>
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy',$post->id],'method'=>'DELETE', 'class'=>'d-inline']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                                {!! Form::close() !!} 
                                           </div>
                                        </div>

                               </div>
                               <br>
                            @endforeach
                        @else
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">You have not posted anything !!!</li>
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>
@endsection
