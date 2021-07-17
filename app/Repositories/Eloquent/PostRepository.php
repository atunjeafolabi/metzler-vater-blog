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
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function create(array $data): ?Model
    {
        $post = $this->post->create($data);

        return $post;
    }

    public function findById($id): ?Model
    {
        $post = $this->post->find($id);

        return $post;
    }

    public function findAll(): ?Collection
    {
        $posts = $this->post->all();

        return $posts;
    }

    public function paginate($perPage = 5): LengthAwarePaginator
    {
        $posts = $this->post->paginate($perPage);

        return $posts;
    }

    public function update(array $data, $id): void
    {
        // TODO: Implement update() method.
    }

    public function delete($id): void
    {
        // TODO: Implement delete() method.
    }

    public function findBy($attribute, $value): ?Model
    {
        // TODO: Implement findBy() method.
    }

    public function findBySlug($slug) : ?Model
    {
        $post = $this->post->where(["slug" => $slug])->first();

        return $post;
    }

    public function getRecentPosts($lastInsertedRows = 5) : ?Collection
    {
        $recentPosts = $this->post->latest()->take($lastInsertedRows)->get();

        return $recentPosts;
    }
}
