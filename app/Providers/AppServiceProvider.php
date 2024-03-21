<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\SocialRepository;
use App\Repositories\SocialRepositoryInterface;
use App\Repositories\PublisherRepository;
use App\Repositories\PublisherRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(SocialRepositoryInterface::class, SocialRepository::class);
        $this->app->bind(PublisherRepositoryInterface::class, PublisherRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
