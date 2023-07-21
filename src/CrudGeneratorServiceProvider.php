<?php

namespace Aminurdev\CrudGenerator;

use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider extends ServiceProvider{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'CrudGenerator');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/CrudGenerator'),
            __DIR__.'/Models' => resource_path('Models/CrudGenerator'),
            __DIR__.'/Http/Controllers' => resource_path('Http/Controllers/CrudGenerator'),
            __DIR__.'/database/migrations' => resource_path('database/migrations/CrudGenerator')
        ]);
    }

    public function register()
    {

    }

}