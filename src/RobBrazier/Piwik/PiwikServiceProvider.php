<?php namespace RobBrazier\Piwik;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use RobBrazier\Piwik\Repository\Config\FileConfigRepository;
use RobBrazier\Piwik\Repository\Request\GuzzleRequestRepository;

class PiwikServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('piwik.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('piwik.config', function() {
            return new FileConfigRepository;
        });

        $this->app->bind('piwik.request', function() {
            $config = $this->app->make('piwik.config');
            return new GuzzleRequestRepository($config, new Client());
        });

        $this->app->bind('piwik', function() {
            $config = $this->app->make('piwik.config');
            $request = $this->app->make('piwik.request');
        	return new Piwik($config, $request);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides() {
        return ['RobBrazier\Piwik\Piwik'];
    }

}