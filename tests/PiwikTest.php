<?php

namespace tests;

use \RobBrazier\Piwik\Piwik;

class PiwikTest extends \PHPUnit_Framework_TestCase {

    private $piwik;
    private $last_visits_count = 2;
    private $site_id = 7;
    private $tag;

    public function setUp() {

        parent::setUp();

        $this->piwik = new Piwik(array('piwik_url' => 'http://demo.piwik.org', 'site_id' => $this->site_id, 'apikey' => 'anonymous', 'username' => '', 'password' => '', 'format' => 'json', 'period' => 'yesterday'));

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
     */

    public function testActionsJson() {
        $this->assertEquals(gettype($this->piwik->actions('json')), 'object');
    }

    public function testActionsPhp() {
        $this->assertEquals(gettype($this->piwik->actions('php')), 'double');
    }

    public function testActionsHtml() {
        $this->assertEquals(gettype($this->piwik->actions('html')), 'string');
    }

    public function testActionsOriginal() {
        $this->assertEquals(gettype($this->piwik->actions('original')), 'string');
    }

    /**
     * Downloads Tests
     * [json, php, html and original]
     */

    public function testDownloadsJson() {
        $this->assertEquals(gettype($this->piwik->downloads('json')), 'array');
    }

    public function testDownloadsPhp() {
        $this->assertEquals(gettype($this->piwik->downloads('php')), 'array');
    }

    public function testDownloadsHtml() {
        $this->assertEquals(gettype($this->piwik->downloads('html')), 'string');
    }

    public function testDownloadsOriginal() {
        $this->assertEquals(gettype($this->piwik->downloads('original')), 'string');
    }

    /**
     * Keywords Tests
     * [json, php, html and original]
     */

    public function testKeywordsJson() {
        $this->assertEquals(gettype($this->piwik->keywords('json')), 'array');
    }

    public function testKeywordsPhp() {
        $this->assertEquals(gettype($this->piwik->keywords('php')), 'array');
    }

    public function testKeywordsHtml() {
        $this->assertEquals(gettype($this->piwik->keywords('html')), 'string');
    }

    public function testKeywordsOriginal() {
        $this->assertEquals(gettype($this->piwik->keywords('original')), 'string');
    }

    /**
     * Last Visits Tests
     * [json, php, html and original]
     */

    public function testLastVisitsJson() {
        $this->assertEquals(gettype($this->piwik->last_visits($this->last_visits_count, 'json')), 'array');
    }

    public function testLastVisitsPhp() {
        $this->assertEquals(gettype($this->piwik->last_visits($this->last_visits_count, 'php')), 'array');
    }

    public function testLastVisitsHtml() {
        $this->assertEquals(gettype($this->piwik->last_visits($this->last_visits_count, 'html')), 'string');
    }

    public function testLastVisitsOriginal() {
        $this->assertEquals(gettype($this->piwik->last_visits($this->last_visits_count, 'original')), 'string');
    }

    /**
     * Last Visits Parsed Tests
     * [json and php]
     */

    public function testLastVisitsParsedJson() {
        $this->assertEquals(gettype($this->piwik->last_visits_parsed($this->last_visits_count, 'json')), 'array');
    }

    public function testLastVisitsParsedPhp() {
        $this->assertEquals(gettype($this->piwik->last_visits_parsed($this->last_visits_count, 'php')), 'array');
    }

//    public function testLastVisitsParsedHtml() {
//        $this->assertEquals(gettype($this->piwik->last_visits_parsed($this->last_visits_count, 'html')), 'array');
//        print_r($this->piwik->last_visits_parsed($this->last_visits_count, 'original'));
//    }
//
//    public function testLastVisitsParsedOriginal() {
//        $this->assertEquals(gettype($this->piwik->last_visits_parsed($this->last_visits_count, 'original')), 'array');
//        print_r($this->piwik->last_visits_parsed($this->last_visits_count, 'original'));
//    }

    /**
     * Outlinks Tests
     * [json, php, html and original]
     */

    public function testOutlinksJson() {
        $this->assertEquals(gettype($this->piwik->outlinks('json')), 'array');
    }

    public function testOutlinksPhp() {
        $this->assertEquals(gettype($this->piwik->outlinks('php')), 'array');
    }

    public function testOutlinksHtml() {
        $this->assertEquals(gettype($this->piwik->outlinks('html')), 'string');
    }

    public function testOutlinksOriginal() {
        $this->assertEquals(gettype($this->piwik->outlinks('original')), 'string');
    }

    /**
     * Page Titles Tests
     * [json, php, html and original]
     */

    public function testPageTitlesJson() {
        $this->assertEquals(gettype($this->piwik->page_titles('json')), 'array');
    }

    public function testPageTitlesPhp() {
        $this->assertEquals(gettype($this->piwik->page_titles('php')), 'array');
    }

    public function testPageTitlesHtml() {
        $this->assertEquals(gettype($this->piwik->page_titles('html')), 'string');
    }

    public function testPageTitlesOriginal() {
        $this->assertEquals(gettype($this->piwik->page_titles('original')), 'string');
    }

    /**
     * Search Engines Tests
     * [json, php, html and original]
     */

    public function testSearchEnginesJson() {
        $this->assertEquals(gettype($this->piwik->search_engines('json')), 'array');
    }

    public function testSearchEnginesPhp() {
        $this->assertEquals(gettype($this->piwik->search_engines('php')), 'array');
    }

    public function testSearchEnginesHtml() {
        $this->assertEquals(gettype($this->piwik->search_engines('html')), 'string');
    }

    public function testSearchEnginesOriginal() {
        $this->assertEquals(gettype($this->piwik->search_engines('original')), 'string');
    }

    /**
     * Unique Visitors Tests
     * [json, php, html and original]
     */

    public function testUniqueVisitorsJson() {
        $this->assertEquals(gettype($this->piwik->unique_visitors('json')), 'object');
    }

    public function testUniqueVisitorsPhp() {
        $this->assertEquals(gettype($this->piwik->unique_visitors('php')), 'double');
    }

    public function testUniqueVisitorsHtml() {
        $this->assertEquals(gettype($this->piwik->unique_visitors('html')), 'string');
    }

    public function testUniqueVisitorsOriginal() {
        $this->assertEquals(gettype($this->piwik->unique_visitors('original')), 'string');
    }

    /**
     * Visits Tests
     * [json, php, html and original]
     */

    public function testVisitsJson() {
        $this->assertEquals(gettype($this->piwik->visits('json')), 'object');
    }

    public function testVisitsPhp() {
        $this->assertEquals(gettype($this->piwik->visits('php')), 'double');
    }

    public function testVisitsHtml() {
        $this->assertEquals(gettype($this->piwik->visits('html')), 'string');
    }

    public function testVisitsOriginal() {
        $this->assertEquals(gettype($this->piwik->visits('original')), 'string');
    }

    /**
     * Websites Tests
     * [json, php, html and original]
     */

    public function testWebsitesJson() {
        $this->assertEquals(gettype($this->piwik->websites('json')), 'array');
    }

    public function testWebsitesPhp() {
        $this->assertEquals(gettype($this->piwik->websites('php')), 'array');
    }

    public function testWebsitesHtml() {
        $this->assertEquals(gettype($this->piwik->websites('html')), 'string');
    }

    public function testWebsitesOriginal() {
        $this->assertEquals(gettype($this->piwik->websites('original')), 'string');
    }

    /**
     * Tag Test
     */

    public function testTag() {
        $this->assertEquals(json_encode($this->piwik->tag()), json_encode($this->tag));
    }

    /**
     * SEO Rank Tests
     * [json, php, html and original]
     */

    public function testSeoRankJson() {
        $this->assertEquals(gettype($this->piwik->seo_rank($this->site_id, 'json')), 'array');
    }

    public function testSeoRankPhp() {
        $this->assertEquals(gettype($this->piwik->seo_rank($this->site_id, 'php')), 'array');
    }

    public function testSeoRankHtml() {
        $this->assertEquals(gettype($this->piwik->seo_rank($this->site_id, 'html')), 'string');
    }

    public function testSeoRankOriginal() {
        $this->assertEquals(gettype($this->piwik->seo_rank($this->site_id, 'original')), 'string');
    }


     /**
     * Version Tests
     */

    public function testVersion() {
        $this->assertEquals(gettype($this->piwik->version()->value), 'string');
    }

    /**
     * Custom Test
     */

    public function testCustom() {
        $this->assertEquals(gettype($this->piwik->custom('SitesManager.getSitesIdFromSiteUrl', array('url'=>'http://forum.piwik.org'), false, false, 'json')), 'array');
    }

}
