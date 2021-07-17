<?php
namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PostRepositoryInterface
{
    public function findbySlug($slug) : ?Model;
    public function getRecentPosts() : ?Collection;
}
