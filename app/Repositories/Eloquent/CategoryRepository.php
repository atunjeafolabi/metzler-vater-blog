<?php


namespace App\Repositories\Eloquent;

use App\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Repository;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}
