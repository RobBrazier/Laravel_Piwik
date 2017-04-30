<?php
namespace RobBrazier\Piwik;
use Orchestra\Testbench\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Module\ActionsModule;
use RobBrazier\Piwik\Module\APIModule;
use RobBrazier\Piwik\Module\EventsModule;
use RobBrazier\Piwik\Module\LiveModule;
use RobBrazier\Piwik\Module\ProviderModule;
use RobBrazier\Piwik\Module\ReferrersModule;
use RobBrazier\Piwik\Module\SEOModule;
use RobBrazier\Piwik\Module\SitesManagerModule;
use RobBrazier\Piwik\Module\VisitorInterestModule;
use RobBrazier\Piwik\Module\VisitsSummaryModule;
use RobBrazier\Piwik\Repository\ConfigRepository;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

/**
 * Class PiwikTest
 * @package RobBrazier\Piwik
 */
class PiwikTest extends TestCase {

    /**
     * @var Prophet
     */
    private $prophet;

    private $request;
    private $config;

    /**
     * @var Piwik
     */
    private $piwik;

    /**
     * @var RequestOptions
     */
    private $requestOptions;

    /**
     * @var string
     */
    private $expectedResponse;

    public function setUp() {
        $this->prophet = new Prophet();
        $this->request = $this->prophet->prophesize(RequestRepository::class);
        $this->config = $this->prophet->prophesize(ConfigRepository::class);
        $this->piwik = new Piwik($this->config->reveal(), $this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = "foo";
    }

    public function testGetActions() {
        $actions = $this->piwik->getActions();
        $this->assertInstanceOf(ActionsModule::class, $actions);
    }

    public function testGetAPI() {
        $api = $this->piwik->getAPI();
        $this->assertInstanceOf(APIModule::class, $api);
    }

    public function testGetEvents() {
        $events = $this->piwik->getEvents();
        $this->assertInstanceOf(EventsModule::class, $events);
    }

    public function testGetLive() {
        $live = $this->piwik->getLive();
        $this->assertInstanceOf(LiveModule::class, $live);
    }

    public function testGetProvider() {
        $provider = $this->piwik->getProvider();
        $this->assertInstanceOf(ProviderModule::class, $provider);
    }

    public function testGetReferrers() {
        $referrers = $this->piwik->getReferrers();
        $this->assertInstanceOf(ReferrersModule::class, $referrers);
    }

    public function testGetSEO() {
        $seo = $this->piwik->getSEO();
        $this->assertInstanceOf(SEOModule::class, $seo);
    }

    public function testGetSitesManager() {
        $sitesManager = $this->piwik->getSitesManager();
        $this->assertInstanceOf(SitesManagerModule::class, $sitesManager);
    }

    public function testGetVisitorInterest() {
        $visitorInterest = $this->piwik->getVisitorInterest();
        $this->assertInstanceOf(VisitorInterestModule::class, $visitorInterest);
    }

    public function testGetVisitsSummary() {
        $visitsSummary = $this->piwik->getVisitsSummary();
        $this->assertInstanceOf(VisitsSummaryModule::class, $visitsSummary);
    }

    public function testGetTag() {
        $siteId = "1";
        $piwikUrl = "piwik.example.com";
        $this->config->get(Option::PIWIK_URL)->willReturn("http://$piwikUrl");
        $this->config->get(Option::SITE_ID)->willReturn($siteId);
        $tag = $this->piwik->getTag();
        $this->assertContains($piwikUrl, $tag);
        $this->assertContains("'setSiteId', $siteId", $tag);
    }

    public function testGetCustom() {
        $expected = "custom result";
        $this->request->send($this->requestOptions)->willReturn($expected);
        $response = $this->piwik->getCustom($this->requestOptions);
        $this->assertEquals($expected, $response);
    }

    public function testActions() {
        $this->requestOptions
            ->setMethod("VisitsSummary.getActions");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->actions();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testDownloads() {
        $this->requestOptions
            ->setMethod("Actions.getDownloads");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->downloads();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testKeywords() {
        $this->requestOptions
            ->setMethod("Referrers.getKeywords");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->keywords();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testLastVisits() {
        $count = 1;
        $this->requestOptions
            ->setArguments([
                "filter_limit" => $count
            ])
            ->setMethod("Live.getLastVisitsDetails");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->last_visits($count);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testLastVisitsParsed() {
        $contents = file_get_contents(__DIR__ . '/Module/resources/Live.getLastVisitsDetails.json');
        $this->expectedResponse = json_decode($contents);
        $format = "json";
        $count = 1;
        $this->requestOptions
            ->setFormat($format)
            ->setArguments([
                "filter_limit" => $count
            ])
            ->setMethod("Live.getLastVisitsDetails");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->last_visits_parsed($count, $format)[0];
        $this->assertNotNull($response["time"]);
        $this->assertNotNull($response["title"]);
        $this->assertNotNull($response["link"]);
        $this->assertNotNull($response["provider"]);
        $this->assertNotNull($response["country"]);
        $this->assertNotNull($response["country_icon"]);
        $this->assertNotNull($response["os"]);
        $this->assertNotNull($response["os_icon"]);
        $this->assertNotNull($response["browser"]);
        $this->assertNotNull($response["browser_icon"]);
    }

    public function testOutlinks() {
        $this->requestOptions
            ->setMethod("Actions.getOutlinks");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->outlinks();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testPageTitles() {
        $this->requestOptions
            ->setMethod("Actions.getPageTitles");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->page_titles();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testSearchEngines() {
        $this->requestOptions
            ->setMethod("Referrers.getSearchEngines");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->search_engines();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testUniqueVisitors() {
        $this->requestOptions
            ->setMethod("VisitsSummary.getUniqueVisitors");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->unique_visitors();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testVisits() {
        $this->requestOptions
            ->setMethod("VisitsSummary.getVisits");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->visits();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testWebsites() {
        $this->requestOptions
            ->setMethod("Referrers.getWebsites");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->websites();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testSeoRank() {
        $siteId = 1;
        $url = "http://website.url";
        $siteUrlRequestOptions = clone $this->requestOptions;
        $siteUrlRequestOptions->usePeriod(false)
            ->setSiteId($siteId)
            ->setMethod("SitesManager.getSiteUrlsFromId");
        $this->request->send($siteUrlRequestOptions)->willReturn([$url]);
        $seoRequestOptions = clone $this->requestOptions;
        $seoRequestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments([
                "url" => $url
            ])
            ->setMethod("SEO.getRank");
        $this->request->send($seoRequestOptions)->willReturn($this->expectedResponse);
        $response = $this->piwik->seo_rank($siteId);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testTag() {
        $siteId = "1";
        $piwikUrl = "piwik.example.com";
        $this->config->get(Option::PIWIK_URL)->willReturn("http://$piwikUrl");
        $this->config->get(Option::SITE_ID)->willReturn($siteId);
        $tag = $this->piwik->tag();
        $this->assertContains($piwikUrl, $tag);
        $this->assertContains("'setSiteId', $siteId", $tag);
    }

    public function testVersion() {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod("API.getPiwikVersion");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $version = $this->piwik->version();
        $this->assertEquals($this->expectedResponse, $version);
    }

}