<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\BlogPost' => 'App\Policies\BlogPostPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('home.secret', function($user){
            return $user->is_admin;
        });

        // Before all Gate
        Gate::before(function($user, $ability) {
            if ($user->is_admin && in_array($ability, ['update', 'delete', 'restore'])) {
                return true;
            }
        });
    }
}
