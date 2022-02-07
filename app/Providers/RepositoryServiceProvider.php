<?php

namespace App\Providers;

use App\Repository\Admin\AdminRepository;
use App\Repository\Admin\AdminRepositoryInterface;
use App\Repository\BaseRepository;
use App\Repository\Blog\Category\CategoryRepository;
use App\Repository\Blog\Category\CategoryRepositoryInterface;
use App\Repository\Blog\Post\PostRepository;
use App\Repository\Blog\Post\PostRepositoryInterface;
use App\Repository\Blog\Comment\CommentRepository;
use App\Repository\Blog\Comment\CommentRepositoryInterface;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
	$this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }
}
