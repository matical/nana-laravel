<?php

namespace ksmz\NanaLaravel;

use Illuminate\Support\ServiceProvider;

class NanaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('nana', function () {
            return new NanaManager($this->app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['nana'];
    }

    protected function bootConfig()
    {
        $configPath = __DIR__ . '/../config/nana.php';

        $this->publishes([$configPath => config_path('nana.php')]);
        $this->mergeConfigFrom($configPath, 'nana');
    }
}
