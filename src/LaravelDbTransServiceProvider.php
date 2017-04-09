<?php

namespace Goszowski\LaravelDbTrans;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class LaravelDbTransServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      if (Config::get('laraveldbtrans.use_package_routes') === NULL or Config::get('laraveldbtrans.use_package_routes') === true)
        include __DIR__ . '/routes.php';

      $this->publishes([
          __DIR__ . '/config.php' => config_path('laraveldbtrans.php', 'config'),
      ], 'config');

      $this->publishes([
        __DIR__.'/database/migrations/' => database_path('/migrations')
      ], 'migrations');

      $this->publishes([
          __DIR__.'/views' => base_path('resources/views/vendor/laravel-db-trans'),
      ], 'views');

      $this->loadViewsFrom(__DIR__ . '/views', 'laravel-db-trans');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
