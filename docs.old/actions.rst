Piwik::actions()
================
::

	Piwik::actions([string $format]);

Arguments
---------

``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::actions('json');`` will return something like the following stdClass::

	stdClass Object
	(
    	[value] => 40
	)