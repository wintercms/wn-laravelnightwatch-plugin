<?php

namespace Winter\LaravelNightwatch;

use Illuminate\Auth\AuthManager;
use Laravel\Nightwatch\Facades\Nightwatch;
use Laravel\Nightwatch\NightwatchServiceProvider;
use System\Classes\PluginBase;
use Winter\LaravelNightwatch\Classes\AuthManager as ClassesAuthManager;
use Winter\Storm\Support\Facades\Config;

/**
 * LaravelNightwatch Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'winter.laravelnightwatch::lang.plugin.name',
            'description' => 'winter.laravelnightwatch::lang.plugin.description',
            'author'      => 'Winter',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {
        // Provide the winter.nightwatch config under the nightwatch namespace
        Config::set('nightwatch', Config::get('winter.nightwatch::config'));

        if ($this->app->environment() === 'local') {
            Nightwatch::handleUnrecoverableExceptionsUsing(function ($e) {
                dd('Nightwatch Unrecoverable Exception', $e);
            });
        }

        $this->app->singleton(AuthManager::class, function () {
            return ClassesAuthManager::instance();
        });

        $this->app->register(NightwatchServiceProvider::class);
    }
}
