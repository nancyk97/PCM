<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CommentServiceInterface;
use App\Services\CommentService;
use App\Repositories\CommentRepositoryInterface;
use App\Repositories\CommentRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
   
    }

    public function boot()
    {
        //
    }
}