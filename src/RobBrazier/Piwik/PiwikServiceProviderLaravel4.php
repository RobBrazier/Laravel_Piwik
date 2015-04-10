<?php namespace RobBrazier\Piwik;

use Illuminate\Support\ServiceProvider;

class PiwikServiceProviderLaravel4 extends ServiceProvider {

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
	public function boot()
	{
		$this->package('robbrazier/piwik');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app['piwik'] = $this->app->share(function($app) {
            return new Piwik;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('piwik');
	}

}