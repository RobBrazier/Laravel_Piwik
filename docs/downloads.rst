Piwik::downloads()
==================
::
	
	Piwik::downloads([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::downloads('json');`` will return something like the following stdClass::
	
	stdClass Object
	(
	    [value] => 5
	)