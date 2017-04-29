Library Usage
============

There are two ways of using the Piwik Library;
1) Using the Laravel Facade
2) Using the app container

Facade
------
If you have added the alias for Piwik to app.php, you can use the library as follows::
	
	Piwik::method()

App Container
------
If you don't want to use the static Facade method of accessing the class, you can also do it non-statically via any of the following  App/Service Container interfaces::

	$this->app['piwik']->method()
	$this->app->make('piwik')->method()
	App::make('piwik')->method()