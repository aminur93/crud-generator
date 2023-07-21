<?php

namespace Aminurdev\CrudGenerator;

use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider extends ServiceProvider{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'CrudGenerator');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // $this->publishes([
        //     __DIR__.'/views' => resource_path('views/vendor/CrudGenerator'),
        //     __DIR__.'/Models' => app_path('Models/Employee.php'),
        //     __DIR__.'/Http/Controllers' => app_path('Http/Controllers/CrudGenerator'),
        //     __DIR__.'/database/migrations' => database_path('database/migrations/CrudGenerator')
        // ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/crud_generator' => base_path(),
            ], 'CrudGenerator-all');
        }
    }

    public function register()
    {

    }

}