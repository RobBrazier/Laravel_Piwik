<?php
namespace RobBrazier\Piwik;
use DOMDocument;
use GuzzleHttp\Client;
use Orchestra\Testbench\TestCase;
use RobBrazier\Piwik\Config\Options;
use RobBrazier\Piwik\Repository\Config\FileConfigRepository;
use RobBrazier\Piwik\Repository\Request\GuzzleRequestRepository;

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
        $config = new FileConfigRepository();
        $request = new GuzzleRequestRepository($config, new Client());
        $this->piwik = new Piwik($config, $request);
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
     * Actions Tests
     * [json, php, html and original]
     */
    public function testActionsJson() {
        $this->assertObjectHasAttribute("value", $this->piwik->actions('json'));
    }
    public function testActionsPhp() {
        $this->assertGreaterThan(0, $this->piwik->actions('php'));
    }
    public function testActionsHtml() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->actions('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }
    public function testActionsOriginal() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->actions('original'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }
    /**
     * Downloads Tests
     * [json, php, html and original]
     */
    public function testDownloadsJson() {
        $downloads = $this->piwik->downloads('json');
        foreach ($downloads as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("nb_visits", $d);
            $this->assertObjectHasAttribute("nb_hits", $d);
            $this->assertObjectHasAttribute("sum_time_spent", $d);
        }
    }
    public function testDownloadsPhp() {
        $downloads = $this->piwik->downloads('php');
        foreach ($downloads as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("nb_hits", $d);
            $this->assertArrayHasKey("sum_time_spent", $d);
        }
    }
    public function testDownloadsHtml() {
        $downloads = $this->piwik->downloads('html');
        $document = new DOMDocument;
        $document->loadHTML($downloads);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    public function testDownloadsOriginal() {
        $downloads = $this->piwik->downloads('original');
        $document = new DOMDocument;
        $document->loadHTML($downloads);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    /**
     * Keywords Tests
     * [json, php, html and original]
     */
    public function testKeywordsJson() {
        $keywords = $this->piwik->keywords('json');
        foreach ($keywords as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("nb_visits", $d);
            $this->assertObjectHasAttribute("nb_actions", $d);
            $this->assertObjectHasAttribute("max_actions", $d);
            $this->assertObjectHasAttribute("sum_visit_length", $d);
            $this->assertObjectHasAttribute("bounce_count", $d);
            $this->assertObjectHasAttribute("nb_visits_converted", $d);
            $this->assertObjectHasAttribute("segment", $d);
            $this->assertObjectHasAttribute("idsubdatatable", $d);
        }
    }
    public function testKeywordsPhp() {
        $keywords = $this->piwik->keywords('php');
        foreach ($keywords as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("nb_actions", $d);
            $this->assertArrayHasKey("max_actions", $d);
            $this->assertArrayHasKey("sum_visit_length", $d);
            $this->assertArrayHasKey("bounce_count", $d);
            $this->assertArrayHasKey("nb_visits_converted", $d);
            $this->assertArrayHasKey("segment", $d);
            $this->assertArrayHasKey("idsubdatatable", $d);
        }
    }
    public function testKeywordsHtml() {
        $keywords = $this->piwik->keywords('html');
        $document = new DOMDocument;
        $document->loadHTML($keywords);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    public function testKeywordsOriginal() {
        $keywords = $this->piwik->keywords('html');
        $document = new DOMDocument;
        $document->loadHTML($keywords);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    /**
     * Last Visits Tests
     * [json, php, html and original]
     */
    public function testLastVisitsJson() {
        $lastVisits = $this->piwik->last_visits($this->last_visits_count, 'json');
        foreach ($lastVisits as $d) {
            $this->assertObjectHasAttribute("idSite", $d);
            $this->assertObjectHasAttribute("idVisit", $d);
            $this->assertObjectHasAttribute("actionDetails", $d);
        }
    }
    public function testLastVisitsPhp() {
        $lastVisits = $this->piwik->last_visits($this->last_visits_count, 'php');
        foreach ($lastVisits as $d) {
            $this->assertArrayHasKey("idSite", $d);
            $this->assertArrayHasKey("idVisit", $d);
            $this->assertArrayHasKey("actionDetails", $d);
        }
    }
    public function testLastVisitsHtml() {
        $lastVisits = $this->piwik->last_visits($this->last_visits_count, 'html');
        $document = new DOMDocument;
        $document->loadHTML($lastVisits);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    public function testLastVisitsOriginal() {
        $lastVisits = $this->piwik->last_visits($this->last_visits_count, 'original');
        $document = new DOMDocument;
        $document->loadHTML($lastVisits);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    /**
     * Last Visits Parsed Tests
     * [json and php]
     */
    public function testLastVisitsParsedJson() {
        $lastVisitsParsed = $this->piwik->last_visits_parsed($this->last_visits_count, 'json');
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
        $lastVisitsParsed = $this->piwik->last_visits_parsed($this->last_visits_count, 'php');
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
    /**
     * Outlinks Tests
     * [json, php, html and original]
     */
    public function testOutlinksJson() {
        $outlinks = $this->piwik->outlinks('json');
        foreach ($outlinks as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("nb_visits", $d);
            $this->assertObjectHasAttribute("nb_hits", $d);
            $this->assertObjectHasAttribute("sum_time_spent", $d);
            $this->assertObjectHasAttribute("idsubdatatable", $d);
        }
    }
    public function testOutlinksPhp() {
        $outlinks = $this->piwik->outlinks('php');
        foreach ($outlinks as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("nb_hits", $d);
            $this->assertArrayHasKey("sum_time_spent", $d);
            $this->assertArrayHasKey("idsubdatatable", $d);
        }
    }
    public function testOutlinksHtml() {
        $outlinks = $this->piwik->outlinks('html');
        $document = new DOMDocument;
        $document->loadHTML($outlinks);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    public function testOutlinksOriginal() {
        $outlinks = $this->piwik->outlinks('original');
        $document = new DOMDocument;
        $document->loadHTML($outlinks);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    /**
     * Page Titles Tests
     * [json, php, html and original]
     */
    public function testPageTitlesJson() {
        $pageTitles = $this->piwik->page_titles('json');
        foreach ($pageTitles as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("nb_visits", $d);
            $this->assertObjectHasAttribute("nb_hits", $d);
            $this->assertObjectHasAttribute("sum_time_spent", $d);
            $this->assertObjectHasAttribute("avg_time_generation", $d);
        }
    }
    public function testPageTitlesPhp() {
        $pageTitles = $this->piwik->page_titles('php');
        foreach ($pageTitles as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("nb_hits", $d);
            $this->assertArrayHasKey("sum_time_spent", $d);
            $this->assertArrayHasKey("avg_time_generation", $d);
        }
    }
    public function testPageTitlesHtml() {
        $pageTitles = $this->piwik->page_titles('html');
        $document = new DOMDocument;
        $document->loadHTML($pageTitles);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    public function testPageTitlesOriginal() {
        $pageTitles = $this->piwik->page_titles('original');
        $document = new DOMDocument;
        $document->loadHTML($pageTitles);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    /**
     * Search Engines Tests
     * [json, php, html and original]
     */
    public function testSearchEnginesJson() {
        $searchEngines = $this->piwik->search_engines('json');
        foreach ($searchEngines as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("nb_visits", $d);
            $this->assertObjectHasAttribute("url", $d);
            $this->assertObjectHasAttribute("logo", $d);
            $this->assertObjectHasAttribute("sum_visit_length", $d);
        }
    }
    public function testSearchEnginesPhp() {
        $searchEngines = $this->piwik->search_engines('php');
        foreach ($searchEngines as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("url", $d);
            $this->assertArrayHasKey("logo", $d);
            $this->assertArrayHasKey("sum_visit_length", $d);
        }
    }
    public function testSearchEnginesHtml() {
        $searchEngines = $this->piwik->search_engines('html');
        $document = new DOMDocument;
        $document->loadHTML($searchEngines);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    public function testSearchEnginesOriginal() {
        $searchEngines = $this->piwik->search_engines('original');
        $document = new DOMDocument;
        $document->loadHTML($searchEngines);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    /**
     * Unique Visitors Tests
     * [json, php, html and original]
     */
    public function testUniqueVisitorsJson() {
        $this->app->config[self::PERIOD] = "yesterday";
        $uniqueVisitors = $this->piwik->unique_visitors('json');
        $this->assertGreaterThan(0, $uniqueVisitors->value);
    }
    public function testUniqueVisitorsPhp() {
        $this->app->config[self::PERIOD] = "yesterday";
        $uniqueVisitors = $this->piwik->unique_visitors('php');
        $this->assertGreaterThan(0, $uniqueVisitors);
    }
    public function testUniqueVisitorsHtml() {
        $this->app->config[self::PERIOD] = "yesterday";
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->unique_visitors('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }
    public function testUniqueVisitorsOriginal() {
        $this->app->config[self::PERIOD] = "yesterday";
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->unique_visitors('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }
    /**
     * Visits Tests
     * [json, php, html and original]
     */
    public function testVisitsJson() {
        $visits = $this->piwik->visits('json');
        $this->assertGreaterThan(0, $visits->value);
    }
    public function testVisitsPhp() {
        $visits = $this->piwik->visits('php');
        $this->assertGreaterThan(0, $visits);
    }
    public function testVisitsHtml() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->visits('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }
    public function testVisitsOriginal() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->visits('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }
    public function testVisitsCustomDateRange() {
        $date = getdate();
        $day = $date["mday"];
        $month = $date["mon"];
        $year = $date["year"];
        $last_year = $year - 1;
        $date_range = sprintf("%d-%d-%d,%d-%d-%d", $last_year, $month, $day, $year, $month, $day);
        $options = new Options();
        $options->setPeriod($date_range);
        $this->app->config[self::PERIOD] = $date_range;
        $visits = $this->piwik->visits('json');
        $this->assertGreaterThan(0, $visits->value);
    }
    /**
     * Websites Tests
     * [json, php, html and original]
     */
    public function testWebsitesJson() {
        $websites = $this->piwik->websites('json');
        foreach ($websites as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("nb_visits", $d);
            $this->assertObjectHasAttribute("nb_actions", $d);
            $this->assertObjectHasAttribute("max_actions", $d);
            $this->assertObjectHasAttribute("sum_visit_length", $d);
            $this->assertObjectHasAttribute("bounce_count", $d);
            $this->assertObjectHasAttribute("nb_visits_converted", $d);
            $this->assertObjectHasAttribute("segment", $d);
            $this->assertObjectHasAttribute("idsubdatatable", $d);
        }
    }
    public function testWebsitesPhp() {
        $websites = $this->piwik->websites('php');
        foreach ($websites as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("nb_actions", $d);
            $this->assertArrayHasKey("max_actions", $d);
            $this->assertArrayHasKey("sum_visit_length", $d);
            $this->assertArrayHasKey("bounce_count", $d);
            $this->assertArrayHasKey("nb_visits_converted", $d);
            $this->assertArrayHasKey("segment", $d);
            $this->assertArrayHasKey("idsubdatatable", $d);
        }
    }
    public function testWebsitesHtml() {
        $keywords = $this->piwik->websites('html');
        $document = new DOMDocument;
        $document->loadHTML($keywords);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    public function testWebsitesOriginal() {
        $keywords = $this->piwik->websites('original');
        $document = new DOMDocument;
        $document->loadHTML($keywords);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    /**
     * Tag Test
     */
    public function testTag() {
        $this->assertEquals($this->piwik->tag(), $this->tag);
    }
    /**
     * SEO Rank Tests
     * [json, php, html and original]
     */
    public function testSeoRankJson() {
        $seoRank = $this->piwik->seo_rank($this->site_id, 'json');
        foreach ($seoRank as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("id", $d);
            $this->assertObjectHasAttribute("rank", $d);
            $this->assertObjectHasAttribute("logo", $d);
            $this->assertObjectHasAttribute("logo_link", $d);
            $this->assertObjectHasAttribute("logo_tooltip", $d);
            $this->assertObjectHasAttribute("rank_suffix", $d);
        }
    }
    public function testSeoRankPhp() {
        $seoRank = $this->piwik->seo_rank($this->site_id, 'php');
        foreach ($seoRank as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("id", $d);
            $this->assertArrayHasKey("rank", $d);
            $this->assertArrayHasKey("logo", $d);
            $this->assertArrayHasKey("logo_link", $d);
            $this->assertArrayHasKey("logo_tooltip", $d);
            $this->assertArrayHasKey("rank_suffix", $d);
        }
    }
    public function testSeoRankHtml() {
        $keywords = $this->piwik->seo_rank($this->site_id, 'html');
        $document = new DOMDocument;
        $document->loadHTML($keywords);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    public function testSeoRankOriginal() {
        $keywords = $this->piwik->seo_rank($this->site_id, 'original');
        $document = new DOMDocument;
        $document->loadHTML($keywords);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }
    /**
     * Version Tests
     */
    public function testVersion() {
        $version = $this->piwik->version()->value;
        $this->assertRegExp('/([0-9]+)\.([0-9]+)\.([0-9]+)(\-([a-zA-Z0-9]+))?/', $version);
    }
    /**
     * Custom Test
     */
//    public function testCustom() {
//        $custom = $this->piwik->custom('SitesManager.getSitesIdFromSiteUrl', array('url' => 'http://forum.piwik.org'), false, false, 'json');
//        $this->assertGreaterThan(0, $custom[0]->idsite);
//    }
}