<?php


namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    protected $model;

    public function create(array $data): ?Model
    {
        $post = $this->model->create($data);

        return $post;
    }

    public function findById($id): ?Model
    {
        $post = $this->model->find($id);

        return $post;
    }

    public function findAll(): ?Collection
    {
        $posts = $this->model->all();

        return $posts;
    }

    public function paginate($perPage = 5): LengthAwarePaginator
    {
        $posts = $this->model->orderBy('created_at', 'DESC')->paginate($perPage);

        return $posts;
    }

    public function findWhere($query) : LengthAwarePaginator
    {
        $posts = $this->model->where($query)->orderBy('created_at', 'DESC')->paginate($perPage = 5);

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
}
