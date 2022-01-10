@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('All Posts') }}</h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <br>
                        @if (count($posts) > 0)
                            @foreach ($posts as $post)
                               <div class="row">
                                   
                                        <div class="col-md-5" style="width: 325px; height:200px;">
                                            <a href="/posts/{{$post->id}}"> 
                                                <img class="card-img-top" style="width: 100%; height:100%;" src="/storage/cover_images/{{$post->cover_image}}" alt="Card image cap">
                                            </a>
                                        </div>
                                        <div class="col-md-7">
                                           <div>
                                                <h5><a href="/posts/{{$post->id}}"><b>{{$post->title}}</b></a></h5>
                                                <small class="text-muted">{{$post->user->name}} <b style="font-size: 30px;">&nbsp.&nbsp</b> {{$post->created_at->format('F d, Y')}}</small> 
                                                <p>{{substr($post->body,0,100)}}</p>
                                           </div> 
                                        </div>
                               </div>
                               <br>
                            @endforeach
                        @else
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Nothing Posted  !!!</li>
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>
@endsection
