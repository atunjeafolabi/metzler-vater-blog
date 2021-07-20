<?php
namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function create(array $data) : ?Model;
    public function findById($id) : ?Model;
    public function findAll() : ?Collection;
    public function findBy($attribute, $value) : ?Model;
    public function paginate($perPage) : LengthAwarePaginator;
    public function findWhere($query) : LengthAwarePaginator;
    public function update($id, array $data);
    public function delete($id) : bool;
}
