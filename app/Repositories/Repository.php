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
        $model = $this->model->create($data);

        return $model;
    }

    public function findById($id): ?Model
    {
        $model = $this->model->find($id);

        return $model;
    }

    public function findAll(): ?Collection
    {
        $models = $this->model->all();

        return $models;
    }

    public function paginate($perPage = 5): LengthAwarePaginator
    {
        $models = $this->model->orderBy('created_at', 'DESC')->paginate($perPage);

        return $models;
    }

    public function findWhere($query) : LengthAwarePaginator
    {
        $models = $this->model
            ->where($query)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage = 5);

        return $models;
    }

    public function update($id, array $data)
    {
        $isUpdated = $this->model->where('id', $id)->update($data);

        return $isUpdated;
    }

    public function delete($id) : bool
    {
        $model = $this->model->find($id);

        return ($model ? $model->delete() : false);
    }

    public function findBy($attribute, $value): ?Model
    {
//        $this->find
    }
}
