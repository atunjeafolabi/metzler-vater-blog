<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $imagePath = substr(
        $faker->image(env('FILE_STORAGE_PATH') . 'post-image', $width = 640, $height = 480),
        strlen(env('FILE_STORAGE_PATH'))
    );

    $user = factory(User::class)->create();
    $category = factory(Category::class)->create();

    return [
        'title' => $faker->text('40'),
        'body' => $faker->text,
        'image_path' => $imagePath,
        //        'published_at' => ,
        'created_by' => $user->id,
        'category_id' => $category->id
    ];
});
