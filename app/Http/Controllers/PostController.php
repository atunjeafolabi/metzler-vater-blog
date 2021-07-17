<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->paginate();

        return view("posts.index", ["posts" => $posts]);
    }

    public function show($slug)
    {
        $post = $this->postRepository->findbySlug($slug);

        return view("posts.show", ['post' => $post]);
    }

    public function showCreateForm()
    {
        return view('posts.form.create');
    }

    public function create(CreatePostRequest $request)
    {
        $postDetails = $request->validated();

        $isPostCreated = $this->postRepository->create($postDetails);

        return redirect()->back()->with(["message" => "Post created"]);
    }

    public function recentPosts()
    {
        $recentPosts = $this->postRepository->getRecentPosts();

        return $recentPosts;
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
    }
}
