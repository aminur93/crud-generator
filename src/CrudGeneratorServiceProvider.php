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
            __DIR__.'/Models' => app_path('Models/vendor/CrudGenerator'),
        ]);

        // $this->publishes([
        //     __DIR__.'/Models/Employee.php' => app_path('Employee.php'),
        // ], 'CrudGenerator-model');

        // $this->publishes([
        //     __DIR__.'/src/Http/Controllers/CrudGeneratorController.php' => app_path('Http/Controllers/CrudGeneratorController.php'),
        // ], 'CrudGenerator-controller');

        // $this->publishes([
        //     __DIR__.'/database/migrations/2023_07_21_162655_create_employees_table.php' => database_path('migrations/2023_07_21_162655_create_employees_table.php'),
        // ], 'CrudGenerator-migrations');
    }

    public function register()
    {

    }

}