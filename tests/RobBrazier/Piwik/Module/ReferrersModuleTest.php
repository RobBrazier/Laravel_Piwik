<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class ReferrersModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var ReferrersModule
     */
    private $referrers;

    /**
     * @var RequestOptions
     */
    private $requestOptions;

    /**
     * @var string
     */
    private $expectedResponse;

    public function setUp()
    {
        $this->prophet = new Prophet();
        $this->request = $this->prophet->prophesize(RequestRepository::class);
        $this->referrers = new ReferrersModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = "foo";
    }

    public function testGetReferrerType()
    {
        $this->requestOptions
            ->setMethod("Referrers.getReferrerType");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getReferrerType();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetAll()
    {
        $this->requestOptions
            ->setMethod("Referrers.getAll");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getAll();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetKeywords()
    {
        $this->requestOptions
            ->setMethod("Referrers.getKeywords");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getKeywords();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetKeywordsForPageUrl()
    {
        $url = "http://page.url";
        $this->requestOptions
            ->setArguments([
                "url" => $url
            ])
            ->setMethod("Referrers.getKeywordsForPageUrl");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getKeywordsForPageUrl($url);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetKeywordsForPageTitle()
    {
        $title = "page title";
        $this->requestOptions
            ->setArguments([
                "title" => $title
            ])
            ->setMethod("Referrers.getKeywordsForPageTitle");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getKeywordsForPageTitle($title);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSearchEnginesFromKeywordId()
    {
        $this->requestOptions
            ->setMethod("Referrers.getSearchEnginesFromKeywordId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getSearchEnginesFromKeywordId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSearchEngines()
    {
        $this->requestOptions
            ->setMethod("Referrers.getSearchEngines");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getSearchEngines();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetKeywordsFromSearchEngineId()
    {
        $this->requestOptions
            ->setMethod("Referrers.getKeywordsFromSearchEngineId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getKeywordsFromSearchEngineId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetCampaigns()
    {
        $this->requestOptions
            ->setMethod("Referrers.getCampaigns");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getCampaigns();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetKeywordsFromCampaignId()
    {
        $this->requestOptions
            ->setMethod("Referrers.getKeywordsFromCampaignId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getKeywordsFromCampaignId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetWebsites()
    {
        $this->requestOptions
            ->setMethod("Referrers.getWebsites");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getWebsites();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetUrlsFromWebsiteId()
    {
        $this->requestOptions
            ->setMethod("Referrers.getUrlsFromWebsiteId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getUrlsFromWebsiteId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSocials()
    {
        $this->requestOptions
            ->setMethod("Referrers.getSocials");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getSocials();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetUrlsForSocial()
    {
        $this->requestOptions
            ->setMethod("Referrers.getUrlsForSocial");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getUrlsForSocial();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNumberOfDistinctSearchEngines()
    {
        $this->requestOptions
            ->setMethod("Referrers.getNumberOfDistinctSearchEngines");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getNumberOfDistinctSearchEngines();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNumberOfDistinctKeywords()
    {
        $this->requestOptions
            ->setMethod("Referrers.getNumberOfDistinctKeywords");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getNumberOfDistinctKeywords();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNumberOfDistinctCampaigns()
    {
        $this->requestOptions
            ->setMethod("Referrers.getNumberOfDistinctCampaigns");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getNumberOfDistinctCampaigns();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNumberOfDistinctWebsites()
    {
        $this->requestOptions
            ->setMethod("Referrers.getNumberOfDistinctWebsites");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getNumberOfDistinctWebsites();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNumberOfDistinctWebsitesUrls()
    {
        $this->requestOptions
            ->setMethod("Referrers.getNumberOfDistinctWebsitesUrls");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->referrers->getNumberOfDistinctWebsitesUrls();
        $this->assertEquals($this->expectedResponse, $response);
    }

}
