@extends('layouts.app')

@section('content')
    <div class="col-lg-8">
        <form action="{{route('update-user', ['id' => $user->id])}}" class="bg-light p-5 contact-form" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{session()->get('message')}}</strong>
                </div>
            @endif
            <h1 class="pb-3">Edit User</h1>
            <div class="mb-5">
                <img src="{{env('AVATAR_PUBLIC_PATH').$user->avatar}}" alt="user Image" class="user-image">
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{old('name', $user->name)}}">
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Enter email" value="{{old('email', $user->email)}}">
            </div>
            <div class="form-group">
                <textarea name="description" id="" cols="30" rows="7" class="form-control" placeholder="Enter a brief description about user">{{old('description', $user->description)}}</textarea>
            </div>
            <div class="form-group">
                <input type="file" name="avatar" class="form-control" placeholder="User Image">
            </div>
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-primary py-3 px-5">
            </div>
        </form>
    </div>
@endsection
