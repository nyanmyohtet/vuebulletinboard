<?php

namespace App\Providers;

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
        // Dao Registration
        $this->app->bind("App\Contracts\Dao\Auth\AuthDaoInterface", "App\Dao\Auth\AuthDao");
        // Business logic registration
        $this->app->bind("App\Contracts\Services\Auth\AuthServiceInterface", "App\Services\Auth\AuthService");
        // Dao Registration
        $this->app->bind("App\Contracts\Dao\User\UserDaoInterface", "App\Dao\User\UserDao");
        // Business logic registration
        $this->app->bind("App\Contracts\Services\User\UserServiceInterface", "App\Services\User\UserService");
        // Dao Registration
        $this->app->bind("App\Contracts\Dao\Post\PostDaoInterface", "App\Dao\Post\PostDao");
        // Business logic registration
        $this->app->bind("App\Contracts\Services\Post\PostServiceInterface", "App\Services\Post\PostService");
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
