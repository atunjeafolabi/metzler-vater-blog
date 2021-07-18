@extends('layouts.app')

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
            <h3 class="pb-3">Edit Post</h3>
            <div class="mb-5">
                <img src="{{env('FILE_PUBLIC_PATH').$post->image_path}}" alt="Post Image" class="post-image">
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
                <input type="file" name="post_image" class="form-control" placeholder="Post Image">
            </div>
            <div class="form-group">
                <input type="submit" value="Add" class="btn btn-primary py-3 px-5">
            </div>
        </form>
    </div>
@endsection
