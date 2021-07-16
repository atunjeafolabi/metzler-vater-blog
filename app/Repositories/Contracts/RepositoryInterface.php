<?php
namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function create(array $data) : void;
    public function findById($id) : ?Model;
    public function findAll() : ?Collection;
    public function findBy($attribute, $value) : ?Model;
    public function paginate($perPage) : ?Collection;
    public function update(array $data, $id) : void;
    public function delete($id) : void;
}
