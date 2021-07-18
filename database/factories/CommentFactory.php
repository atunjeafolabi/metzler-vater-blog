<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use App\User;
use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    $post = factory(Post::class)->create();
    $user = factory(User::class)->create();

    return [
        'title' => $faker->text(40),
        'body' => $faker->text(200),
        'post_id' => $post->id,
        'created_by' => $user->id
    ];
});
