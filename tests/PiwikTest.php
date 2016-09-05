<?php

namespace tests;

use DOMDocument;
use Illuminate\Support\Facades\Config;
use Mockery;
use RobBrazier\Piwik\Piwik;

class PiwikTest extends \PHPUnit_Framework_TestCase {

    private $piwik;
    private $last_visits_count = 2;
    private $piwik_url = "http://demo.piwik.org";
    private $site_id = 7;
    private $apikey = "anonymous";
    private $format = "json";
    private $period = "yesterday";
    private $tag;


    public function setUp() {

        parent::setUp();

        Config::shouldReceive("get", "piwik.curl_timeout")->andReturn(5.0);
        Config::shouldReceive("get", "piwik.verify_peer")->andReturn(true);

        $this->piwik = new Piwik(array('piwik_url' => $this->piwik_url, 'site_id' => $this->site_id, 'apikey' => $this->apikey, 'format' => $this->format, 'period' => $this->period));

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
     * Actions Tests
     * [json, php, html and original]
     * @covers \RobBrazier\Piwik\Piwik::actions
     */
    public function testActionsJson() {
        $this->assertObjectHasAttribute("value", $this->piwik->actions('json'));
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::actions
     */
    public function testActionsPhp() {
        $this->assertGreaterThan(0, $this->piwik->actions('php'));
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::actions
     */
    public function testActionsHtml() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->actions('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::actions
     */
    public function testActionsOriginal() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->actions('original'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }

    /**
     * Downloads Tests
     * [json, php, html and original]
     * @covers \RobBrazier\Piwik\Piwik::downloads
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

    /**
     * @covers \RobBrazier\Piwik\Piwik::downloads
     */
    public function testDownloadsPhp() {
        $downloads = $this->piwik->downloads('php');
        foreach ($downloads as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("nb_hits", $d);
            $this->assertArrayHasKey("sum_time_spent", $d);
        }
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::downloads
     */
    public function testDownloadsHtml() {
        $downloads = $this->piwik->downloads('html');
        $document = new DOMDocument;
        $document->loadHTML($downloads);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::downloads
     */
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
     * @covers \RobBrazier\Piwik\Piwik::keywords
     */
    public function testKeywordsJson() {
        $keywords = $this->piwik->keywords('json');
        foreach ($keywords as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("nb_uniq_visitors", $d);
            $this->assertObjectHasAttribute("nb_visits", $d);
            $this->assertObjectHasAttribute("nb_actions", $d);
            $this->assertObjectHasAttribute("nb_users", $d);
            $this->assertObjectHasAttribute("max_actions", $d);
            $this->assertObjectHasAttribute("sum_visit_length", $d);
            $this->assertObjectHasAttribute("bounce_count", $d);
            $this->assertObjectHasAttribute("nb_visits_converted", $d);
            $this->assertObjectHasAttribute("segment", $d);
            $this->assertObjectHasAttribute("idsubdatatable", $d);
        }
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::keywords
     */
    public function testKeywordsPhp() {
        $keywords = $this->piwik->keywords('php');
        foreach ($keywords as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_uniq_visitors", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("nb_actions", $d);
            $this->assertArrayHasKey("nb_users", $d);
            $this->assertArrayHasKey("max_actions", $d);
            $this->assertArrayHasKey("sum_visit_length", $d);
            $this->assertArrayHasKey("bounce_count", $d);
            $this->assertArrayHasKey("nb_visits_converted", $d);
            $this->assertArrayHasKey("segment", $d);
            $this->assertArrayHasKey("idsubdatatable", $d);
        }
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::keywords
     */
    public function testKeywordsHtml() {
        $keywords = $this->piwik->keywords('html');
        $document = new DOMDocument;
        $document->loadHTML($keywords);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::keywords
     */
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
     * @covers \RobBrazier\Piwik\Piwik::last_visits
     */
    public function testLastVisitsJson() {
        $lastVisits = $this->piwik->last_visits($this->last_visits_count, 'json');
        foreach ($lastVisits as $d) {
            $this->assertObjectHasAttribute("idSite", $d);
            $this->assertObjectHasAttribute("idVisit", $d);
            $this->assertObjectHasAttribute("actionDetails", $d);
        }
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::last_visits
     */
    public function testLastVisitsPhp() {
        $lastVisits = $this->piwik->last_visits($this->last_visits_count, 'php');
        foreach ($lastVisits as $d) {
            $this->assertArrayHasKey("idSite", $d);
            $this->assertArrayHasKey("idVisit", $d);
            $this->assertArrayHasKey("actionDetails", $d);
        }
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::last_visits
     */
    public function testLastVisitsHtml() {
        $lastVisits = $this->piwik->last_visits($this->last_visits_count, 'html');
        $document = new DOMDocument;
        $document->loadHTML($lastVisits);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::last_visits
     */
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
     * @covers \RobBrazier\Piwik\Piwik::last_visits_parsed
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

    /**
     * @covers \RobBrazier\Piwik\Piwik::last_visits_parsed
     */
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
     * @covers \RobBrazier\Piwik\Piwik::outlinks
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

    /**
     * @covers \RobBrazier\Piwik\Piwik::outlinks
     */
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

    /**
     * @covers \RobBrazier\Piwik\Piwik::outlinks
     */
    public function testOutlinksHtml() {
        $outlinks = $this->piwik->outlinks('html');
        $document = new DOMDocument;
        $document->loadHTML($outlinks);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::outlinks
     */
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
     * @covers \RobBrazier\Piwik\Piwik::page_titles
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

    /**
     * @covers \RobBrazier\Piwik\Piwik::page_titles
     */
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

    /**
     * @covers \RobBrazier\Piwik\Piwik::page_titles
     */
    public function testPageTitlesHtml() {
        $pageTitles = $this->piwik->page_titles('html');
        $document = new DOMDocument;
        $document->loadHTML($pageTitles);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::page_titles
     */
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
     * @covers \RobBrazier\Piwik\Piwik::search_engines
     */
    public function testSearchEnginesJson() {
        $searchEngines = $this->piwik->search_engines('json');
        foreach ($searchEngines as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("nb_uniq_visitors", $d);
            $this->assertObjectHasAttribute("nb_visits", $d);
            $this->assertObjectHasAttribute("url", $d);
            $this->assertObjectHasAttribute("logo", $d);
            $this->assertObjectHasAttribute("sum_visit_length", $d);
        }
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::search_engines
     */
    public function testSearchEnginesPhp() {
        $searchEngines = $this->piwik->search_engines('php');
        foreach ($searchEngines as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_uniq_visitors", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("url", $d);
            $this->assertArrayHasKey("logo", $d);
            $this->assertArrayHasKey("sum_visit_length", $d);
        }
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::search_engines
     */
    public function testSearchEnginesHtml() {
        $searchEngines = $this->piwik->search_engines('html');
        $document = new DOMDocument;
        $document->loadHTML($searchEngines);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::search_engines
     */
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
     * @covers \RobBrazier\Piwik\Piwik::unique_visitors
     */
    public function testUniqueVisitorsJson() {
        $uniqueVisitors = $this->piwik->unique_visitors('json');
        $this->assertGreaterThan(0, $uniqueVisitors->value);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::unique_visitors
     */
    public function testUniqueVisitorsPhp() {
        $uniqueVisitors = $this->piwik->unique_visitors('php');
        $this->assertGreaterThan(0, $uniqueVisitors);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::unique_visitors
     */
    public function testUniqueVisitorsHtml() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->unique_visitors('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::unique_visitors
     */
    public function testUniqueVisitorsOriginal() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->unique_visitors('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }

    /**
     * Visits Tests
     * [json, php, html and original]
     * @covers \RobBrazier\Piwik\Piwik::visits
     */
    public function testVisitsJson() {
        $visits = $this->piwik->visits('json');
        $this->assertGreaterThan(0, $visits->value);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::visits
     */
    public function testVisitsPhp() {
        $visits = $this->piwik->visits('php');
        $this->assertGreaterThan(0, $visits);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::visits
     */
    public function testVisitsHtml() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->visits('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::visits
     */
    public function testVisitsOriginal() {
        $document = new DOMDocument;
        $document->loadHTML($this->piwik->visits('html'));
        $this->assertGreaterThan(0, $document->getElementsByTagName("td")->item(0)->nodeValue);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::visits
     */
    public function testVisitsCustomDateRange() {
        $date = getdate();
        $day = $date["mday"];
        $month = $date["mon"];
        $year = $date["year"];
        $last_year = $year - 1;
        $date_range = sprintf("%d-%d-%d,%d-%d-%d", $last_year, $month, $day, $year, $month, $day);
        $this->piwik = new Piwik(array('piwik_url' => $this->piwik_url, 'site_id' => $this->site_id, 'apikey' => $this->apikey, 'format' => $this->format, 'period' => $date_range));
        $visits = $this->piwik->visits('json');
        $this->assertGreaterThan(0, $visits->value);
    }

    /**
     * Websites Tests
     * [json, php, html and original]
     * @covers \RobBrazier\Piwik\Piwik::websites
     */
    public function testWebsitesJson() {
        $websites = $this->piwik->websites('json');
        foreach ($websites as $d) {
            $this->assertObjectHasAttribute("label", $d);
            $this->assertObjectHasAttribute("nb_uniq_visitors", $d);
            $this->assertObjectHasAttribute("nb_visits", $d);
            $this->assertObjectHasAttribute("nb_actions", $d);
            $this->assertObjectHasAttribute("nb_users", $d);
            $this->assertObjectHasAttribute("max_actions", $d);
            $this->assertObjectHasAttribute("sum_visit_length", $d);
            $this->assertObjectHasAttribute("bounce_count", $d);
            $this->assertObjectHasAttribute("nb_visits_converted", $d);
            $this->assertObjectHasAttribute("segment", $d);
            $this->assertObjectHasAttribute("idsubdatatable", $d);
        }
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::websites
     */
    public function testWebsitesPhp() {
        $websites = $this->piwik->websites('php');
        foreach ($websites as $d) {
            $this->assertArrayHasKey("label", $d);
            $this->assertArrayHasKey("nb_uniq_visitors", $d);
            $this->assertArrayHasKey("nb_visits", $d);
            $this->assertArrayHasKey("nb_actions", $d);
            $this->assertArrayHasKey("nb_users", $d);
            $this->assertArrayHasKey("max_actions", $d);
            $this->assertArrayHasKey("sum_visit_length", $d);
            $this->assertArrayHasKey("bounce_count", $d);
            $this->assertArrayHasKey("nb_visits_converted", $d);
            $this->assertArrayHasKey("segment", $d);
            $this->assertArrayHasKey("idsubdatatable", $d);
        }
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::websites
     */
    public function testWebsitesHtml() {
        $keywords = $this->piwik->websites('html');
        $document = new DOMDocument;
        $document->loadHTML($keywords);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::websites
     */
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
     * @covers \RobBrazier\Piwik\Piwik::tag
     */
    public function testTag() {
        $this->assertEquals($this->piwik->tag(), $this->tag);
    }

    /**
     * SEO Rank Tests
     * [json, php, html and original]
     * @covers \RobBrazier\Piwik\Piwik::seo_rank
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

    /**
     * @covers \RobBrazier\Piwik\Piwik::seo_rank
     */
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

    /**
     * @covers \RobBrazier\Piwik\Piwik::seo_rank
     */
    public function testSeoRankHtml() {
        $keywords = $this->piwik->seo_rank($this->site_id, 'html');
        $document = new DOMDocument;
        $document->loadHTML($keywords);
        $headingsCount = $document->getElementsByTagName("th")->length;
        $contentSize = $document->getElementsByTagName("td")->length;
        $this->assertEquals(0, $contentSize % $headingsCount);
    }

    /**
     * @covers \RobBrazier\Piwik\Piwik::seo_rank
     */
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
     * @covers \RobBrazier\Piwik\Piwik::version
     */
    public function testVersion() {
        $version = $this->piwik->version()->value;
        $this->assertRegExp('/([0-9]+)\.([0-9]+)\.([0-9]+)(\-([a-zA-Z0-9]+))?/', $version);
    }

    /**
     * Custom Test
     * @covers \RobBrazier\Piwik\Piwik::custom
     */
    public function testCustom() {
        $custom = $this->piwik->custom('SitesManager.getSitesIdFromSiteUrl', array('url' => 'http://forum.piwik.org'), false, false, 'json');
        $this->assertGreaterThan(0, $custom[0]->idsite);
    }

}
