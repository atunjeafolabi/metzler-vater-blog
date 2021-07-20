@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="col-xl-8 pb-5 px-md-5">
        <div class="row pt-md-4">
            <div class="col-lg-12">
                <h1 class="mb-5">All users</h1>
            </div>
            @foreach($users as $user)
                <div class="col-md-12">
                    <div class="blog-entry ftco-animate d-md-flex">
                        <a href="{{route('user', ['id' => $user->id])}}" class="img img-2" style="background-image: url({{env('AVATAR_PUBLIC_PATH').$user->avatar}});"></a>
                        <div class="text text-2 pl-md-4">
                            <h3 class="mb-2"><a href="{{route('user', ['id' => $user->id])}}">{{$user->name}}</a></h3>
                            <div class="meta-wrap">
                                <p class="meta">
                                    Joined:&nbsp;
                                    <span><i class="icon-calendar mr-2"></i>{{$user->created_at}}</span>
                                </p>
                            </div>
                            <p class="mb-4">{{str_limit($user->description, 200)}}</p>
                            <p><a href="{{route('user', ["id" => $user->id])}}" class="btn-custom">Read More <span class="ion-ios-arrow-forward"></span></a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col">
                {{$users->links()}}
            </div>
        </div>
    </div>
@endsection
