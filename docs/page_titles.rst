Piwik::page_titles()
====================
::
	
	Piwik::page_titles([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::page_titles('json');`` will return something like the following Array::
	
	Array
	(
	    [0] => stdClass Object
	        (
	            [label] =>  example.com
	            [nb_visits] => 2
	            [nb_uniq_visitors] => 1
	            [nb_hits] => 3
	            [sum_time_spent] => 54
	            [entry_nb_uniq_visitors] => 1
	            [entry_nb_visits] => 2
	            [entry_nb_actions] => 5
	            [entry_sum_visit_length] => 56
	            [entry_bounce_count] => 0
	            [avg_time_on_page] => 27
	            [bounce_rate] => 0%
	            [exit_rate] => 0%
	        )
	)