<?php

namespace App\Repositories\Eloquent;

use App\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Repository;

final class CommentRepository extends Repository implements CommentRepositoryInterface
{
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}
