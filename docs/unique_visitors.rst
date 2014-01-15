Piwik::unique_visitors()
========================
::
	
	Piwik::unique_visitors([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::unique_visitors('json');`` will return something like the following stdClass::
	
	stdClass Object
	(
	    [value] => 7
	)