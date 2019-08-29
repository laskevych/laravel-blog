<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Support\Facades\Schema;
use App\BlogPost;
use App\Observers\BlogPostObserver;
use App\Comment;
use App\Observers\CommentObserver;
use App\Services\Counter;
Use App\Http\Resources\PostCommentResource;
use Illuminate\Http\Resources\Json\Resource;

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

        // Database index (key) doesnt be create becouse length very much.
        Schema::defaultStringLength(191);

        Blade::component('components.badge', 'badge');
        Blade::component('components.updated', 'updated');
        Blade::component('components.info_card', 'infocard');
        Blade::component('components.tags', 'tags');
        Blade::component('components.errors', 'errors');
        Blade::component('components.success', 'success');
        Blade::component('components.comment-form', 'commentForm');

        // use * to use for all views
        view()->composer(['posts.show', 'posts.index', 'home'], ActivityComposer::class);

        // Observers
        BlogPost::observe(BlogPostObserver::class);
        Comment::observe(CommentObserver::class);

        $this->app->singleton(Counter::class, function ($app) {
            return new Counter(
                $app->make('Illuminate\Contracts\Cache\Factory'),
                $app->make('Illuminate\Contracts\Session\Session'),
                env('CACHE_COUNTER_TIMEOUT', 5)
            );
        });

        $this->app->bind(
            'App\Contracts\CounterContract',
            Counter::class
        );

        // Без обертки data для одного ресурса. И глобально
        PostCommentResource::withoutWrapping();
        Resource::withoutWrapping();
    }
}
