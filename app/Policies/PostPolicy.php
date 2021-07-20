<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param   User  $user
     * @param   Post  $post
     *
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return ((int)$user->id === (int)$post->created_by || $user->isAdmin());
    }

    public function delete(User $user, Post $post)
    {
        return ((int)$user->id === (int)$post->created_by || $user->isAdmin());
    }
}
