<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\PostRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            $view->with('recentPosts', (new PostRepository(new Post()))->getRecentPosts());
        });

        View::composer('layouts.app', function ($view) {
            $view->with('categories', (new CategoryRepository(new Category()))->findAll());
        });
    }
}
