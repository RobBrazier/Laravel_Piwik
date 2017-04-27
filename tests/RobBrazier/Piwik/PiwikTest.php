<?php

namespace RobBrazier\Piwik;

use DOMDocument;
use Orchestra\Testbench\TestCase;
use RobBrazier\Piwik\Config\Options;
use RobBrazier\Piwik\Request\RequestOptions;

/**
 * Class PiwikTest
 * @package RobBrazier\Piwik
 * @covers \RobBrazier\Piwik\Piwik
 */
class PiwikTest extends TestCase {

    /**
     * @var Piwik
     */
    private $piwik;

    /**
     * @var int
     */
    private $last_visits_count = 2;

    /**
     * @var string
     */
    private $piwik_url = "http://demo.piwik.org";

    /**
     * @var string
     */
    private $site_id = "7";

    /**
     * @var string
     */
    private $apikey = "anonymous";

    /**
     * @var string
     */
    private $format = "json";

    /**
     * @var string
     */
    private $period = "last7";

    /**
     * @var float
     */
    private $curl_timeout = 10.0;

    /**
     * @var bool
     */
    private $verify_peer = true;

    /**
     * @var string
     */
    private $tag;

    const PIWIK_URL = "piwik.piwik_url";
    const SITE_ID = "piwik.site_id";
    const API_KEY = "piwik.api_key";
    const FORMAT = "piwik.format";
    const PERIOD = "piwik.period";
    const CURL_TIMEOUT = "piwik.curl_timeout";
    const VERIFY_PEER = "piwik.verify_peer";


    public function setUp() {

        parent::setUp();

        $this->piwik = new Piwik();

        $this->tag = <<<EOT
<!-- Piwik -->
<script type="text/javascript">
var _paq = _paq || [];
(function(){ var u=(("https:" == document.location.protocol) ? "https://demo.piwik.org/" : "http://demo.piwik.org/");
_paq.push(['setSiteId', $this->site_id]);
_paq.push(['setTrackerUrl', u+'piwik.php']);
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript'; g.defer=true; g.async=true; g.src=u+'piwik.js';
s.parentNode.insertBefore(g,s); })();
</script>
<!-- End Piwik Code -->
EOT;

    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set(self::PIWIK_URL, $this->piwik_url);
        $app['config']->set(self::SITE_ID, $this->site_id);
        $app['config']->set(self::API_KEY, $this->apikey);
        $app['config']->set(self::FORMAT, $this->format);
        $app['config']->set(self::PERIOD, $this->period);
        $app['config']->set(self::CURL_TIMEOUT, $this->curl_timeout);
        $app['config']->set(self::VERIFY_PEER, $this->verify_peer);
    }

    /**
     * Last Visits Parsed Tests
     * [json and php]
     */
    public function testLastVisitsParsedJson() {
        $lastVisitsParsed = $this->piwik->getLastVisitsParsed($this->last_visits_count, 'json');
        foreach ($lastVisitsParsed as $d) {
            $this->assertArrayHasKey("time", $d);
            $this->assertArrayHasKey("title", $d);
            $this->assertArrayHasKey("link", $d);
            $this->assertArrayHasKey("ip_address", $d);
            $this->assertArrayHasKey("provider", $d);
            $this->assertArrayHasKey("country", $d);
            $this->assertArrayHasKey("country_icon", $d);
            $this->assertArrayHasKey("os", $d);
            $this->assertArrayHasKey("os_icon", $d);
            $this->assertArrayHasKey("browser", $d);
            $this->assertArrayHasKey("browser_icon", $d);
        }
    }

    public function testLastVisitsParsedPhp() {
        $lastVisitsParsed = $this->piwik->getLastVisitsParsed($this->last_visits_count, 'php');
        foreach ($lastVisitsParsed as $d) {
            $this->assertArrayHasKey("time", $d);
            $this->assertArrayHasKey("title", $d);
            $this->assertArrayHasKey("link", $d);
            $this->assertArrayHasKey("ip_address", $d);
            $this->assertArrayHasKey("provider", $d);
            $this->assertArrayHasKey("country", $d);
            $this->assertArrayHasKey("country_icon", $d);
            $this->assertArrayHasKey("os", $d);
            $this->assertArrayHasKey("os_icon", $d);
            $this->assertArrayHasKey("browser", $d);
            $this->assertArrayHasKey("browser_icon", $d);
        }
    }

}
