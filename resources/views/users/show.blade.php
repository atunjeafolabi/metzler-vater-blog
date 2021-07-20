@extends('layouts.app')

@section('title', 'user')

@section('content')
    <div class="col-lg-8 px-md-5 py-5">
        <div class="row pt-md-4">
            <div class="col-lg-12">
                <h2>
                    <img src="{{env('AVATAR_PUBLIC_PATH').$user->avatar}}" alt="Avatar" class="avatar">
                    {{$user->name}}
                    @auth
                        @can('delete', $user)
                            <form method="POST" class="delete-form" action="{{ route('delete-user', ['id' => $user->id]) }}" onclick="return confirm('Are you sure you want to delete this user?')" style="display: inline-block; float: right">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-icon">
                                    Delete
                                </button>
                            </form>
                        @endcan
                        @can('update', $user)
                            <a href="{{route('update-user-form', ['id' => $user->id])}}" class="btn btn-info edit-btn float-right mt-2 mr-1">Edit</a>
                        @endcan
                    @endauth
                </h2>
            </div>
            <div class="col-lg-12 d-flex p-4">
                <div class="desc">
                    <p>{{$user->description}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
