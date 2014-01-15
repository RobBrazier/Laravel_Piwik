Piwik::websites()
=================
::
	
	Piwik::websites([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::websites('json');`` will return something like the following Array::
	
	Array
	(
	    [0] => stdClass Object
	        (
	            [label] => ericulous.com
	            [nb_uniq_visitors] => 1
	            [nb_visits] => 1
	            [nb_actions] => 10
	            [max_actions] => 10
	            [sum_visit_length] => 79
	            [bounce_count] => 0
	            [nb_visits_converted] => 0
	            [idsubdatatable] => 32
	        )

	    [1] => stdClass Object
	        (
	            [label] => www.youtube.com
	            [nb_uniq_visitors] => 1
	            [nb_visits] => 1
	            [nb_actions] => 1
	            [max_actions] => 1
	            [sum_visit_length] => 0
	            [bounce_count] => 1
	            [nb_visits_converted] => 0
	            [idsubdatatable] => 33
	        )

	)