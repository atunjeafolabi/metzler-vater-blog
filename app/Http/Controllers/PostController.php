<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
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
        $imageName                 = $this->saveImage($request);
        $postData["image_path"] = $imageName;

        $isPostCreated = $this->postRepository->create($postData);

        return redirect()->back()->with(["message" => "Post created"]);
    }

    public function showUpdateForm($slug)
    {
        $post = $this->postRepository->findbySlug($slug);

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
        $postData = $request->except('_method', '_token', 'post_image');

        if ($request->hasFile('post_image')) {
            $imageName                 = $this->saveImage($request);
            $postData["image_path"] = $imageName;
        }

        $isUpdated = $this->postRepository->update($slug, $postData);

        if (!$isUpdated) {
            return redirect()->back();
        }

        return redirect()->route('post', ['slug' => $slug]);
    }

    /**
     * @param   FormRequest  $request
     *
     * @return array|false|string
     */
    private function saveImage(FormRequest $request)
    {
        $imageName = $request->file('post_image')->store('public/post-image');
        $imageName = substr($imageName, strlen('public/'));

        return $imageName;
    }

    public function delete($slug)
    {
        $isDeleted = $this->postRepository->delete($slug);

        if (!$isDeleted) {
            return redirect()->back();
        }

        return redirect()->route('index');
    }
}
