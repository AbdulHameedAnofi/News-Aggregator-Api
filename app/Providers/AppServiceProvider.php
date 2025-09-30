<?php

namespace App\Providers;

use App\Contracts\Repositories\NewsArticleRepositoryInterface;
use App\Repositories\NewsArticleRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(NewsArticleRepositoryInterface::class, NewsArticleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
