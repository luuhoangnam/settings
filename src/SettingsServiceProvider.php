<?php

namespace Namest\Settings;

use Illuminate\Support\ServiceProvider;
use Namest\Settings\Repository as Settings;

/**
 * Class SettingsServiceProvider
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Settings
 *
 */
class SettingsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Publish a config file
        $this->publishes([
            __DIR__ . '/../config/settings.php' => config_path('settings.php')
        ], 'config');

        // Publish your migrations
        $this->publishes([
            __DIR__ . '/../database/migrations/' => base_path('/database/migrations')
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function () {
            $settings = new Repository;
            $settings->preload();

            return $settings;
        });

        include_once __DIR__ . '/helpers.php';
    }
}
