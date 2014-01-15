Piwik::visits()
===============
::
	
	Piwik::visits([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::visits('json');`` will return something like the following stdClass::
	
	stdClass Object
	(
	    [value] => 8
	)