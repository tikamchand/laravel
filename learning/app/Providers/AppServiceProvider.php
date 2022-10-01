<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use App\Models\BlogPost;
use App\Models\comment;
use App\Observers\BlogPostObserver;
use App\Observers\CommentObserver;
use Illuminate\Support\Facades\Blade;
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
       
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('Components.badge', 'badge');
        Blade::component('Components.update', 'update');
        Blade::component('Components.tags', 'tags');
        Blade::component('Components.errors', 'errors');
        view()->composer(['posts.index', 'posts.show'], ActivityComposer::class);

        BlogPost::observe(BlogPostObserver::class);
        comment::observe(CommentObserver::class);
    }
}
