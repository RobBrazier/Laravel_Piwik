Piwik::version()
================
::
	
	Piwik::version([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::version('json');`` will return something like the following stdClass::
	
	stdClass Object
	(
	    [value] => 1.10.1
	)