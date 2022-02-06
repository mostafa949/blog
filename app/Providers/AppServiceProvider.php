<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Blog\Entities\Post;

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
//        view()->composer('*', function ($view) {
//
//            $view->with('latestPosts', Post::where('published', true)->orderBy('updated_at', 'DESC')->take(5)->get(['title', 'slug']));
//        });
    }
}
