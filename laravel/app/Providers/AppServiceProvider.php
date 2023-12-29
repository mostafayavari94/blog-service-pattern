<?php

namespace App\Providers;

use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->app->bind(ArticleService::class, function () {
            return new ArticleService(new ArticleRepository());
        });
    }
}
