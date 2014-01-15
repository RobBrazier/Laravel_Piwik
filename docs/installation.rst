Installation
============

To Install Laravel-Piwik using Composer, the Default method for Laravel, add ``RobBrazier\Piwik`` to ``composer.json``:
:: json
	{
		"require": {
			"RobBrazier\Piwik": "dev-master"
		}
	}

Then, add ``'RobBrazier\Piwik\PiwikServiceProvider'`` and ``'Piwik' => 'RobBrazier\Piwik\Facades\Piwik'`` to ``app/config/app.php``:
:: php
	'providers' = array(
		...
		'RobBrazier\Piwik\PiwikServiceProvider',
		...
	);

	[...]

	'aliases' = array(
		...
		'Piwik' => 'RobBrazier\Piwik\Facades\Piwik',
		...
	);

Next, move the config out of the package, so that it doesn't get overwritten on each update:
:: shell
	php artisan config:publish robbrazier/piwik

Update your packages by running ``composer update``

Finally, go to ``app/config/packages/robbrazier/piwik/config.php`` and add your config settings such as server, username, password, apikey etc.