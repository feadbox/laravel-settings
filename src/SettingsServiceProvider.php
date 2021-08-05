<?php

namespace Feadbox\Settings;

use Feadbox\Settings\Models\Setting;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/settings.php', 'settings');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'settings-migrations');

            $this->publishes([
                __DIR__ . '/../config/settings.php' => config_path('settings.php'),
            ], 'settings-config');
        }

        $this->loadMigrationsFrom([__DIR__ . '/../database/migrations']);

        $this->mergeWithConfigKeys();
    }

    private function mergeWithConfigKeys()
    {
        $keys = config('settings.merge-with-config-keys', []);

        config(Setting::whereIn('key', $keys)->pluck('value', 'key')->toArray());
    }
}
