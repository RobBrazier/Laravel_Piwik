<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class SEOModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;
    private $sitesManager;

    /**
     * @var SEOModule
     */
    private $seo;

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
        $this->sitesManager = $this->prophet->prophesize(SitesManagerModule::class);
        $this->seo = new SEOModule($this->request->reveal(), $this->sitesManager->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = 'foo';
    }

    public function testGetRank()
    {
        $url = 'http://website.url';
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'url' => $url,
            ])
            ->setMethod('SEO.getRank');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->seo->getRank($url);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetRankFromSiteId()
    {
        $siteId = '1';
        $url = 'http://website.url';
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'url' => $url,
            ])
            ->setMethod('SEO.getRank');
        $this->sitesManager->getSiteUrlsFromId($siteId)->willReturn([$url]);
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->seo->getRankFromSiteId($siteId);
        $this->assertEquals($this->expectedResponse, $response);
    }
}
