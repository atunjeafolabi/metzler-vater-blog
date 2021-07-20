<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Repository;
use App\User;

class UserRepository extends Repository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
