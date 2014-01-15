Piwik::search_engines()
=======================
::
	
	Piwik::search_engines([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::search_engines('json');`` will return something like the following Array::
	
	Array
	(
	    [0] => stdClass Object
	        (
	            [label] => Bing
	            [nb_uniq_visitors] => 2
	            [nb_visits] => 2
	            [nb_actions] => 8
	            [max_actions] => 7
	            [sum_visit_length] => 141
	            [bounce_count] => 1
	            [nb_visits_converted] => 0
	            [url] => http://bing.com
	            [logo] => plugins/Referers/images/searchEngines/bing.com.png
	            [idsubdatatable] => 23
	        )

	    [1] => stdClass Object
	        (
	            [label] => Google
	            [nb_uniq_visitors] => 2
	            [nb_visits] => 2
	            [nb_actions] => 4
	            [max_actions] => 3
	            [sum_visit_length] => 12
	            [bounce_count] => 1
	            [nb_visits_converted] => 0
	            [url] => http://google.com
	            [logo] => plugins/Referers/images/searchEngines/google.com.png
	            [idsubdatatable] => 24
	        )

	)