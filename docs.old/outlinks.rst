Piwik::outlinks()
=================
::
	
	Piwik::outlinks([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::outlinks('json');`` will return something like the following Array::
	
	Array
	(
	    [0] => stdClass Object
	        (
	            [label] => google.com
	            [nb_visits] => 1
	            [nb_hits] => 1
	            [sum_time_spent] => 5
	            [idsubdatatable] => 9
	        )

	)