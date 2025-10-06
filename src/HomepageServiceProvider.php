<?php

namespace Tabour\Homepage;

use Illuminate\Support\ServiceProvider;

class HomepageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/homepage.php', 'homepage');
        require_once __DIR__.'/Support/helpers.php';
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tabour-homepage');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tabour-homepage');

        $this->publishes([
            __DIR__.'/../config/homepage.php' => config_path('homepage.php'),
        ], 'tabour-homepage-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/tabour-homepage'),
        ], 'tabour-homepage-views');
    }
}
