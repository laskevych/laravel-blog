<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\BlogPost;
Use App\User;

class ActivityComposer
{
    public function compose(View $view)
    {
        $mostCommented = Cache::remember('blog-post-commented', now()->addMinutes(30), function () {
            return BlogPost::mostCommented()->take(3)->get();
        });

        $mostActiveUsers = Cache::remember('users-most-active', now()->addMinutes(30), function () {
            return User::with('image')->withMostBlogPosts()->take(5)->get();
        });

        $mostActiveUsersLastMonth = Cache::remember('users-most-active-last-month', now()->addMinutes(30), function () {
            return User::with('image')->WithMostBlogPostsLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActiveUsers', $mostActiveUsers);
        $view->with('mostActiveUsersLastMonth', $mostActiveUsersLastMonth);
    }
}