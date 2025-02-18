<?php

namespace Vhar\LaravelRobokassa\Providers;

use Illuminate\Support\ServiceProvider;
use Vhar\LaravelRobokassa\RobokassaManager;

class RobokassaServiceProvider extends ServiceProvider
{
    /**
     * Приложение загружено.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/robokassa.php' => config_path('robokassa.php'),
        ], 'config');
    }

    /**
     * Регистрация сервис-провайдера.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/robokassa.php',
            'robokassa'
        );

        $this->app->singleton('robokassa', function ($app) {
            return new RobokassaManager();
        });

        $this->app->bind('robokassa.merchant', function ($app) {
            return $app->make('robokassa')->merchant();
        });
    }

    /**
     * Получить сервисы предоставляемые сервис-провайдером.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'robokassa',
            'robokassa.merchant',
        ];
    }
}
