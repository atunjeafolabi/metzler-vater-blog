@extends('layouts.app')

@section("title", "Edit Post")

@section('content')
    <div class="col-lg-8">
        <form action="{{route('update-post', ['slug' => $post->slug])}}" class="bg-light p-5 contact-form" method="POST" enctype="multipart/form-data">
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
            <h1 class="pb-3">Edit Post</h1>
            <div class="mb-5">
                <img src="{{env('POST_IMAGE_PUBLIC_PATH').$post->image_path}}" alt="Post Image" class="image-contain">
            </div>
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Post title" value="{{old('title', $post->title)}}">
            </div>
            <div class="form-group">
                <select name="category_id" class="form-control">
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{(old('category_id', $post->category_id) == $category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <textarea name="body" id="" cols="30" rows="7" class="form-control" placeholder="Content">{{old('body', $post->body)}}</textarea>
            </div>
            <div class="form-group">
                <input type="file" name="post-image" class="form-control" placeholder="Post Image">
            </div>
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-primary py-3 px-5">
            </div>
        </form>
    </div>
@endsection
