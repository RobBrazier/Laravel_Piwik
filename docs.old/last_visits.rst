Piwik::last_visits()
=================
::
	
	Piwik::last_visits(integer $count[, string $format]);

Arguments
---------

``$count`` - Limit the number of results returned to this number
``$format`` - A format other than the default one declared in config

Example
-------

``Piwik::last_visits(2, 'json');`` will return something like the following Array::
	
	Array
	(
	    [0] => stdClass Object
	        (
	            [idSite] => 1
	            [idVisit] => 7859
	            [visitIp] => 0.0.0.0
	            [visitorId] => oi23m42i3m409234
	            [visitorType] => new
	            [visitorTypeIcon] => 
	            [visitConverted] => 0
	            [visitConvertedIcon] => 
	            [visitEcommerceStatus] => none
	            [visitEcommerceStatusIcon] => 
	            [actions] => 1
	            [actionDetails] => Array
	                (
	                    [0] => stdClass Object
	                        (
	                            [type] => action
	                            [url] => http://example.com/tag/test/
	                            [pageTitle] => example.com - test
	                            [pageIdAction] => 788
	                            [pageId] => 24694
	                            [serverTimePretty] => Fri 2 Nov 20:54:35
	                            [icon] => 
	                        )

	                )

	            [customVariables] => Array
	                (
	                )

	            [goalConversions] => 0
	            [siteCurrency] => GBP
	            [siteCurrencySymbol] => £
	            [serverDate] => 2012-11-02
	            [visitLocalTime] => 16:54:32
	            [firstActionTimestamp] => 1351889675
	            [lastActionTimestamp] => 1351889675
	            [lastActionDateTime] => 2012-11-02 20:54:35
	            [visitDuration] => 0
	            [visitDurationPretty] => 0s
	            [visitCount] => 1
	            [daysSinceLastVisit] => 0
	            [daysSinceFirstVisit] => 0
	            [daysSinceLastEcommerceOrder] => 0
	            [country] => United States
	            [countryFlag] => plugins/UserCountry/flags/us.png
	            [continent] => North America
	            [location] => United States
	            [provider] => Rr
	            [providerUrl] => http://www.rr.com/
	            [referrerType] => search
	            [referrerTypeName] => Search Engines
	            [referrerName] => Google
	            [referrerKeyword] => Keyword not defined
	            [referrerKeywordPosition] => 16
	            [referrerUrl] => http://piwik.org/faq/general/#faq_144
	            [referrerSearchEngineUrl] => http://google.com
	            [referrerSearchEngineIcon] => plugins/Referers/images/searchEngines/google.com.png
	            [operatingSystem] => Windows 8
	            [operatingSystemShortName] => Win 8
	            [operatingSystemIcon] => plugins/UserSettings/images/os/WI8.gif
	            [browserFamily] => webkit
	            [browserFamilyDescription] => WebKit (Safari, Chrome)
	            [browserName] => Chrome 22.0
	            [browserIcon] => plugins/UserSettings/images/browsers/CH.gif
	            [screenType] => wide
	            [resolution] => 1366x768
	            [screenTypeIcon] => plugins/UserSettings/images/screens/wide.gif
	            [plugins] => pdf, flash, java
	            [pluginsIcons] => Array
	                (
	                    [0] => stdClass Object
	                        (
	                            [pluginIcon] => plugins/UserSettings/images/plugins/pdf.gif
	                            [pluginName] => pdf
	                        )

	                    [1] => stdClass Object
	                        (
	                            [pluginIcon] => plugins/UserSettings/images/plugins/flash.gif
	                            [pluginName] => flash
	                        )

	                    [2] => stdClass Object
	                        (
	                            [pluginIcon] => plugins/UserSettings/images/plugins/java.gif
	                            [pluginName] => java
	                        )

	                )

	            [serverTimestamp] => 1351889675
	            [serverTimePretty] => 20:54:35
	            [serverDatePretty] => Fri 2 Nov
	            [serverDatePrettyFirstAction] => Fri 2 Nov
	            [serverTimePrettyFirstAction] => 20:54:35
	        }

	)