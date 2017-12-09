<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class ActionsModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var ActionsModule
     */
    private $actions;

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
        $this->actions = new ActionsModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = 'foo';
    }

    public function testGet()
    {
        $this->requestOptions
            ->setMethod('Actions.get');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->get();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetPageUrls()
    {
        $this->requestOptions
            ->setMethod('Actions.getPageUrls');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getPageUrls();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetPageUrlsFollowingSiteSearch()
    {
        $this->requestOptions
            ->setMethod('Actions.getPageUrlsFollowingSiteSearch');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getPageUrlsFollowingSiteSearch();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetPageTitlesFollowingSiteSearch()
    {
        $this->requestOptions
            ->setMethod('Actions.getPageTitlesFollowingSiteSearch');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getPageTitlesFollowingSiteSearch();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetEntryPageUrls()
    {
        $this->requestOptions
            ->setMethod('Actions.getEntryPageUrls');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getEntryPageUrls();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetExitPageUrls()
    {
        $this->requestOptions
            ->setMethod('Actions.getExitPageUrls');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getExitPageUrls();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetPageUrl()
    {
        $pageUrl = 'pageUrl';
        $this->requestOptions
            ->setMethod('Actions.getPageUrl')
            ->setArguments([
                'pageUrl' => $pageUrl,
            ]);
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getPageUrl($pageUrl);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetPageTitles()
    {
        $this->requestOptions
            ->setMethod('Actions.getPageTitles');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getPageTitles();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetEntryPageTitles()
    {
        $this->requestOptions
            ->setMethod('Actions.getEntryPageTitles');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getEntryPageTitles();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetExitPageTitles()
    {
        $this->requestOptions
            ->setMethod('Actions.getExitPageTitles');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getExitPageTitles();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetPageTitle()
    {
        $pageName = 'foo';
        $this->requestOptions
            ->setMethod('Actions.getPageTitle')
            ->setArguments([
                'pageName' => $pageName,
            ]);
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getPageTitle($pageName);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetDownloads()
    {
        $this->requestOptions
            ->setMethod('Actions.getDownloads');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getDownloads();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetDownload()
    {
        $downloadUrl = 'downloadUrl';
        $this->requestOptions
            ->setMethod('Actions.getDownload')
            ->setArguments([
                'downloadUrl' => $downloadUrl,
            ]);
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getDownload($downloadUrl);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetOutlinks()
    {
        $this->requestOptions
            ->setMethod('Actions.getOutlinks');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getOutlinks();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetOutlink()
    {
        $outlinkUrl = 'outlinkUrl';
        $this->requestOptions
            ->setMethod('Actions.getOutlink')
            ->setArguments([
                'outlinkUrl' => $outlinkUrl,
            ]);
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getOutlink($outlinkUrl);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSiteSearchKeywords()
    {
        $this->requestOptions
            ->setMethod('Actions.getSiteSearchKeywords');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getSiteSearchKeywords();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSiteSearchNoResultKeywords()
    {
        $this->requestOptions
            ->setMethod('Actions.getSiteSearchNoResultKeywords');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getSiteSearchNoResultKeywords();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSiteSearchCategories()
    {
        $this->requestOptions
            ->setMethod('Actions.getSiteSearchCategories');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->actions->getSiteSearchCategories();
        $this->assertEquals($this->expectedResponse, $response);
    }
}
