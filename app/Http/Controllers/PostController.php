<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;
    private $categoryRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $queryString = $request->query();

        if (!$this->isPaginationQueryString($queryString)) {
            $posts = $this->postRepository->findWhere($queryString);
        } else {
            $posts = $this->postRepository->paginate();
        }

        return view("posts.index", ["posts" => $posts]);
    }

    /**
     * @param   array  $queryString
     *
     * @return bool
     */
    private function isPaginationQueryString(array $queryString)
    {
        return $queryString && isset($queryString['page']);
    }

    public function show($slug)
    {
        $post = $this->postRepository->findbySlug($slug);

        return view("posts.show", ['post' => $post]);
    }

    public function showCreateForm()
    {
        $categories = $this->categoryRepository->findAll();

        return view('posts.form.create', ["categories" => $categories]);
    }

    public function create(CreatePostRequest $request)
    {
        $postDetails               = $request->validated();
        $imageName                 = $this->saveImage($request);
        $postDetails["image_path"] = $imageName;

        $isPostCreated = $this->postRepository->create($postDetails);

        return redirect()->back()->with(["message" => "Post created"]);
    }

    /**
     * @param   CreatePostRequest  $request
     *
     * @return array|false|string
     */
    private function saveImage(CreatePostRequest $request)
    {
        $imageName = $request->file('post_image')->store('public/post-image');
        $imageName = substr($imageName, strlen('public/'));

        return $imageName;
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
