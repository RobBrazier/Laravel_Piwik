<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class SitesManagerModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var SitesManagerModule
     */
    private $sitesManager;

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
        $this->sitesManager = new SitesManagerModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = 'foo';
    }

    public function testGetProvider()
    {
        $group = 'groupName';
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'group' => $group,
            ])
            ->setMethod('SitesManager.getSitesFromGroup');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSitesFromGroup($group);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSiteGroups()
    {
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setMethod('SitesManager.getSiteGroups');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSiteGroups();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSitesFromId()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->setMethod('SitesManager.getSitesFromId');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSitesFromId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSiteUrlsFromId()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->setMethod('SitesManager.getSiteUrlsFromId');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSiteUrlsFromId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSiteUrlsFromIdWithCustomSiteId()
    {
        $siteId = '1';
        $this->requestOptions
            ->usePeriod(false)
            ->setSiteId($siteId)
            ->setMethod('SitesManager.getSiteUrlsFromId');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSiteUrlsFromId($siteId);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetAllSites()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod('SitesManager.getAllSites');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getAllSites();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetAllSitesId()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod('SitesManager.getAllSitesId');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getAllSitesId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSitesWithAdminAccess()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod('SitesManager.getSitesWithAdminAccess');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSitesWithAdminAccess();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSitesWithViewAccess()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod('SitesManager.getSitesWithViewAccess');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSitesWithViewAccess();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSitesWithAtLeastViewAccess()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod('SitesManager.getSitesWithAtLeastViewAccess');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSitesWithAtLeastViewAccess();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSitesIdWithAdminAccess()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod('SitesManager.getSitesIdWithAdminAccess');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSitesIdWithAdminAccess();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSitesIdWithViewAccess()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod('SitesManager.getSitesIdWithViewAccess');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSitesIdWithViewAccess();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSitesIdWithAtLeastViewAccess()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod('SitesManager.getSitesIdWithAtLeastViewAccess');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSitesIdWithAtLeastViewAccess();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSitesIdFromSiteUrl()
    {
        $url = 'http://website.url';
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments([
                'url' => $url,
            ])
            ->setMethod('SitesManager.getSitesIdFromSiteUrl');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->getSitesIdFromSiteUrl($url);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testAddSite()
    {
        $siteName = 'site name';
        $urls = [
            'http://site.one',
            'http://site.two',
        ];
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments([
                'siteName' => $siteName,
                'urls'     => $urls,
            ])
            ->setMethod('SitesManager.addSite');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->sitesManager->addSite($siteName, $urls);
        $this->assertEquals($this->expectedResponse, $response);
    }
}
