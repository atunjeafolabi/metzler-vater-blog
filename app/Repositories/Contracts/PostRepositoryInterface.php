<?php
namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PostRepositoryInterface
{
    public function findBySlug($slug) : ?Model;
    public function getRecentPosts() : ?Collection;
    public function update($slug, array $data);
    public function delete($slug) : bool;
}
