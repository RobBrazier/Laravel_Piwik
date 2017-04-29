Piwik::tag()
============
::
	
	Piwik::tag();

Example
-------

``Piwik::tag();`` will return something like the following String::
	
	<!-- Piwik --> <script type="text/javascript"> 
	var _paq = _paq || []; 
	(function(){ var u=(("https:" == document.location.protocol) ? "https://{$PIWIK_URL}/" : "http://{$PIWIK_URL}/"); 
	_paq.push(['setSiteId', {$IDSITE}]); 
	_paq.push(['setTrackerUrl', u+'piwik.php']); 
	_paq.push(['trackPageView']); 
	_paq.push(['enableLinkTracking']); 
	var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript'; g.defer=true; g.async=true; g.src=u+'piwik.js'; 
	s.parentNode.insertBefore(g,s); })();
	 </script>
	<!-- End Piwik Code -->