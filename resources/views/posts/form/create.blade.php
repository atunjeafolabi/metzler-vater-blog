@extends('layouts.app')

@section('content')
    <div class="col-lg-8">
        <form action="{{route('create-post')}}" class="bg-light p-5 contact-form" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
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
            <h3 class="pb-5">Add New Post</h3>
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Post title" value="{{old('title')}}">
            </div>
            <div class="form-group">
                <select name="category_id" class="form-control">
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <textarea name="body" id="" cols="30" rows="7" class="form-control" placeholder="Content">{{old('body')}}</textarea>
            </div>
            <div class="form-group">
                <input type="file" name="post_image" class="form-control" placeholder="Post Image">
            </div>
            <div class="form-group">
                <input type="submit" value="Add" class="btn btn-primary py-3 px-5">
            </div>
        </form>
    </div>
@endsection
