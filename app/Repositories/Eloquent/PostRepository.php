<?php


namespace App\Repositories\Eloquent;

use App\Post;
use App\Repositories\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\PostRepositoryInterface;

final class PostRepository extends Repository implements PostRepositoryInterface
{
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function findBySlug($slug) : ?Model
    {
        $post = $this->model->where(["slug" => $slug])->first();

        return $post;
    }

    public function getRecentPosts($lastInsertedRows = 5) : ?Collection
    {
        $recentPosts = $this->model->latest()->take($lastInsertedRows)->get();

        return $recentPosts;
    }
}
