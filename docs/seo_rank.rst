Piwik::seo_rank()
=================
::
	
	Piwik::seo_rank([integer $id, string $format]);

Arguments
---------

``$id`` - Override for fetching the SEO Rank of another site ID from your server
``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::seo_rank(1);`` will return something like the following Array::
	
	Array
	(
	    [0] => stdClass Object
	        (
	            [label] => Google PageRank
	            [rank] => 2
	            [logo] => plugins/Referers/images/searchEngines/google.com.png
	            [id] => pagerank
	        )

	    [1] => stdClass Object
	        (
	            [label] => Alexa Rank
	            [rank] => stdClass Object
	                (
	                    [0] => 18083216
	                )

	            [logo] => plugins/Referers/images/searchEngines/alexa.com.png
	            [id] => alexa
	        )

	    [2] => stdClass Object
	        (
	            [label] => Domain Age
	            [rank] => 42 years 306 days
	            [logo] => plugins/SEO/images/whois.png
	            [id] => domain-age
	        )

	)