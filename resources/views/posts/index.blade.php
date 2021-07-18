@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="col-xl-8 py-5 px-md-5">
        <div class="row pt-md-4">
            @foreach($posts as $post)
                <div class="col-md-12">
                    <div class="blog-entry ftco-animate d-md-flex">
                        <a href="{{route('post', ['slug' => $post->slug])}}" class="img img-2" style="background-image: url({{env('FILE_STORAGE').$post->image_path}});"></a>
                        <div class="text text-2 pl-md-4">
                            <h3 class="mb-2"><a href="{{route('post', ['slug' => $post->slug])}}">{{$post->title}}</a></h3>
                            <div class="meta-wrap">
                                <p class="meta">
                                    <span><i class="icon-calendar mr-2"></i>{{$post->created_at}}</span>
                                    <span><a href="{{route('index', ['category_id' => $post->category->id])}}"><i class="icon-folder-o mr-2"></i>{{$post->category->name}}</a></span>
                                    <span>
                                        <i class="icon-comment2 mr-2"></i>
                                        {{$post->comments()->count()}}&nbsp;
                                        {{str_plural('comment', $post->comments()->count())}}
                                    </span>
                                </p>
                            </div>
                            <p class="mb-4">{{str_limit($post->body, 200)}}</p>
                            <p><a href="{{route('post', ["slug" => $post->slug])}}" class="btn-custom">Read More <span class="ion-ios-arrow-forward"></span></a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col">
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection
