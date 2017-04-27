Piwik::custom()
===============
::
	
	Piwik::custom(string $method[, array $arguments, boolean/integer $id, boolean $period, string $format]);

Arguments
---------

``$method`` - the method you want to use to query the Piwik API (See here for more Info).
``$arguments`` - an array of the extra arguments you want to add to the query URL.
``$id`` - either a boolean value, 'true' displaying the site ID as declared in config, and also you can enter custom Site IDs.
``$period`` - toggle whether you want the period & date in the query URL.
``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::custom('SitesManager.getSitesIdFromSiteUrl', array('url'=>'http://example.com'), false, false, 'json');`` will return something like the following Array::

	Array
	(
	    [0] => stdClass Object
	        (
	            [idsite] => 1
	        )

	)