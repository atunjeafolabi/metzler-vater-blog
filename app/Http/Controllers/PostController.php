<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (!$post) {
            abort(404, 'Post does not exist');
        }

        return view("posts.show", ['post' => $post]);
    }

    public function showCreateForm()
    {
        $categories = $this->categoryRepository->findAll();

        return view('posts.form.create', ["categories" => $categories]);
    }

    public function create(CreatePostRequest $request)
    {
        $postData               = $request->validated();
        $postData['created_by'] = Auth::id();
        $imageName              = $this->saveImage($request, 'post-image', env('POST_IMAGE_STORAGE_PATH'));
        $postData["image_path"] = $imageName;

        $isPostCreated = $this->postRepository->create($postData);

        return redirect()->back()->with(["message" => "Post created"]);
    }

    public function showUpdateForm($slug, Request $request)
    {
        $post = $this->postRepository->findbySlug($slug);

        if ($request->user()->cant('update', $post)) {
            abort(403, 'You can only edit posts created by you.');
        }

        if (!$post) {
            abort(404, 'The Post you want to edit does not exist');
        }

        $categories = $this->categoryRepository->findAll();

        return view('posts.form.update', [
            "post" => $post,
            "categories" => $categories
        ]);
    }

    public function update($slug, UpdatePostRequest $request)
    {
        $post = $this->postRepository->findBySlug($slug);

        if ($request->user()->cant('update', $post)) {
            abort(403, 'You can only edit posts created by you.');
        }

        $postData = $request->except('_method', '_token', 'post-image');

        if ($request->hasFile('post-image')) {
            $imageName              = $this->saveImage($request, 'post-image', env('POST_IMAGE_STORAGE_PATH'));
            $postData["image_path"] = $imageName;
        }

        $isUpdated = $this->postRepository->update($slug, $postData);

        if (!$isUpdated) {
            return redirect()->back();
        }

        return redirect()->route('post', ['slug' => $slug]);
    }

    public function delete($slug, Request $request)
    {
        $post = $this->postRepository->findBySlug($slug);

        if ($request->user()->cant('delete', $post)) {
            abort(403, 'You can only delete posts created by you.');
        }

        $isDeleted = $this->postRepository->delete($slug);

        if (!$isDeleted) {
            return redirect()->back();
        }

        return redirect()->route('index');
    }
}
