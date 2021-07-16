<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class CommentRepository extends Repository
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

    public function findBy($attribute, $value): ?Model
    {
        // TODO: Implement findBy() method.
    }

    public function paginate($perPage): ?Collection
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
}
