<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

$factory->define(Post::class, function (Faker $faker) {

    $imageName =  $faker->image(
        env('FILE_STORAGE_PATH') . 'post-image',
        $width = 650,
        $height = 490,
        null,
        false
    );

    $user = factory(User::class)->create();
    $category = factory(Category::class)->create();

    return [
        'title' => $faker->text('40'),
        'body' => $faker->text,
//        'image_path' => Storage::disk('public')->putFile('post-image', $imageFile),
        'image_path' => $imageName,
        //        'published_at' => ,
        'created_by' => $user->id,
        'category_id' => $category->id
    ];
});
