<?php
namespace App\Repositories\Contracts;

use App\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PostRepositoryInterface
{
    public function findBySlug($slug) : ?Post;
    public function getRecentPosts() : ?Collection;
    public function update($slug, array $data);
    public function delete($slug) : bool;
    public function findWithComments($slug) : ?Post;
}
