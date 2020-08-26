<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\PluginManager\PluginManager;

class PluginServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        PluginManager::getInstance($this->app);
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-plugins', function ($app) {
            return PluginManager::getInstance($app);
        });
    }
}