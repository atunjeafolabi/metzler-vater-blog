@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="col-lg-8 px-md-5 py-5">
        <div class="row pt-md-4">
            <div class="col-lg-12">
                <h1>{{$post->title}}</h1>
                <div class="mt-3 mb-5">
                    <img src="{{env('FILE_STORAGE').$post->image_path}}" alt="Post Image" class="post-image">
                </div>
                <p>{{$post->body}}</p>
            </div>
            <div class="col-lg-12 tag-widget post-tag-container mb-5 mt-5">
                <div class="tagcloud">
                    Category: <a href="{{route('index', ['category_id' => $post->category_id])}}" class="tag-cloud-link">{{$post->category->name}}</a>
                </div>
            </div>
            <div class="col-lg-12 about-author d-flex p-4 bg-light">
                <div class="bio mr-5">
                    <img src="{{env('FILE_STORAGE').$post->creator->avatar}}" alt="Avatar" class="avatar mb-4">
                </div>
                <div class="desc">
                    <h3>{{$post->creator->name}}</h3>
                    <p>{{$post->creator->description}}</p>
                </div>
            </div>
            <div class="col-lg-12 pt-5">

                <h3 class="mb-3 font-weight-bold">
                    {{$post->comments->count()}} &nbsp;
                    {{str_plural("Comment", $post->comments->count())}}
                </h3>
                <ul class="comment-list">
                    @foreach($post->comments as $comment)
                        <li class="comment">
                            <div class="vcard bio">
                                <img src="{{env('FILE_STORAGE').$comment->creator->avatar}}" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                                <h3>{{$comment->creator->name}}</h3>
                                <div class="meta">October 03, 2018 at 2:21pm</div>
                                <p>{{$comment->body}}<p>
                                    <a href="#" class="reply">Reply</a>
                                </p>
                            </div>

                            <ul class="children">
                                @foreach($comment->replies as $reply)
                                    <li class="comment">
                                        <div class="vcard bio">
                                            <img src="{{env('FILE_STORAGE').$reply->creator->avatar}}" alt="Image placeholder">
                                        </div>
                                        <div class="comment-body">
                                            <h3>{{$reply->creator->name}}</h3>
                                            <div class="meta">{{$reply->created_at}}</div>
                                            <p>{{$reply->body}}</p>
{{--                                            <p><a href="#" class="reply">Reply</a></p>--}}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>

                <div class="comment-form-wrap pt-5">
                    <h3 class="mb-5">Leave a comment</h3>
                    <form action="#" class="p-3 p-md-5 bg-light">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" class="form-control" id="website">
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                        </div>

                    </form>
                </div>
            </div>
        </div><!-- END-->
    </div>
@endsection
