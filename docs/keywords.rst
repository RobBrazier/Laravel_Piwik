Piwik::keywords()
=================
::
	
	Piwik::keywords([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::keywords('json');`` will return something like the following Array::
	
	Array
	(
	    [0] => stdClass Object
	        (
	            [label] => Keyword not defined
	            [nb_uniq_visitors] => 2
	            [nb_visits] => 2
	            [nb_actions] => 3
	            [max_actions] => 2
	            [sum_visit_length] => 7
	            [bounce_count] => 1
	            [nb_visits_converted] => 0
	            [idsubdatatable] => 30
	        )
	) 
