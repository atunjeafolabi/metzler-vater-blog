<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contract\PostRepositoryInterface::class,
            \App\Repositories\Eloquent\PostRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contract\CommentRepositoryInterface::class,
            \App\Repositories\Eloquent\CommentRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
