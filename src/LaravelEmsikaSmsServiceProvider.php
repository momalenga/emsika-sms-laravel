<?php

namespace Shengamo\LaravelEmsikaSms;

use App\Console\Commands\SendSms;
use Illuminate\Support\ServiceProvider;

class LaravelEmsikaSmsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'shengamo');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'shengamo');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-emsika-sms.php', 'laravel-emsika-sms');

        // Register the service the package provides.
        $this->app->singleton('laravel-emsika-sms', function ($app) {
            return new LaravelEmsikaSms;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-emsika-sms'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-emsika-sms.php' => config_path('laravel-emsika-sms.php'),
        ], 'laravel-emsika-sms.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/shengamo'),
        ], 'laravel-emsika-sms.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/shengamo'),
        ], 'laravel-emsika-sms.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/shengamo'),
        ], 'laravel-emsika-sms.lang');*/

        // Registering package commands.
        $this->commands([
            SendSms::class,
        ]);
    }
}
