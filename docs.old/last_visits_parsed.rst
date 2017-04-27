Piwik::last_visits_parsed()
===========================
::
	
	Piwik::last_visits_parsed(integer $count[, string $format]);

Arguments
---------

``$count`` - Limit the number of results returned to this number
``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::last_visits_parsed(2, 'json');`` will return something like the following Array::
	
	Array
	(
	    [0] => Array
	        (
	            [time] => Nov 2 2012, 8:54 am
	            [title] => example.com - Test
	            [link] => http://example.com/tag/test/
	            [ip_address] => 0.0.0.0
	            [provider] => Rr
	            [country] => United States
	            [country_icon] => us.png
	            [os] => Windows 8
	            [os_icon] => WI8.gif
	            [browser] => Chrome 22.0
	            [browser_icon] => CH.gif
	        )

	)
