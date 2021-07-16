<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\PostRepositoryInterface;

final class PostRepository extends Repository implements PostRepositoryInterface
{

    public function create(array $data): void
    {
        // TODO: Implement create() method.
    }

    public function findById($id): ?Model
    {
        // TODO: Implement findById() method.
    }

    public function findAll(): ?Collection
    {
        // TODO: Implement findAll() method.
    }

    public function paginate($perPage = 15): ?Collection
    {
        // TODO: Implement paginate() method.
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
