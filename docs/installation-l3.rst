Laravel 3 Installation
======================

Step 1
------
Install using Artisan, or download the zipball from GitHub
::

	php artisan bundle:install piwik
or

::

	git clone https://github.com/RobBrazier/Laravel-Piwik.git piwik

Step 2
------
Add laravel-piwik to your bundles.php
::

	'piwik' => array('auto'=>true, 'handles'=>'piwik_install'),

and go to `http://yourdomain.com/piwik_install`

This is a user-friendly way to fill out the config file, just because I thought that'd be nice :)

(Incase you're wondering, `here <http://cl.ly/image/Kddc>`_'s a screenshot).