<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class APIModuleTest extends TestCase
{


    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var APIModule
     */
    private $api;

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
        $this->api = new APIModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = "foo";
    }

    public function testGetPiwikVersion()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod("API.getPiwikVersion");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getPiwikVersion();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetIpFromHeader()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod("API.getIpFromHeader");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getIpFromHeader();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSettings()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setMethod("API.getSettings");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getSettings();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSegmentsMetadata()
    {
        $siteIds = [1, 2, 3];
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments([
                "idSites" => implode(",", $siteIds)
            ])
            ->setMethod("API.getSegmentsMetadata");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getSegmentsMetadata($siteIds);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetMetadata()
    {
        $this->requestOptions
            ->setMethod("API.getMetadata");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getMetadata();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetReportMetadata()
    {
        $siteIds = [1, 2, 3];
        $this->requestOptions
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments([
                "idSites" => implode(",", $siteIds)
            ])
            ->setMethod("API.getReportMetadata");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getReportMetadata($siteIds);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetProcessedReport()
    {
        $apiModule = "API";
        $apiAction = "getProcessedReport";
        $this->requestOptions
            ->setArguments([
                "apiModule" => $apiModule,
                "apiAction" => $apiAction
            ])
            ->setMethod("API.getProcessedReport");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getProcessedReport($apiModule, $apiAction);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetReportPagesMetadata()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->setMethod("API.getReportPagesMetadata");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getReportPagesMetadata();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetWidgetMetadata()
    {
        $this->requestOptions
            ->usePeriod(false)
            ->setMethod("API.getWidgetMetadata");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getWidgetMetadata();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGet()
    {
        $this->requestOptions
            ->setMethod("API.get");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->get();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetRowEvolution()
    {
        $apiModule = "API";
        $apiAction = "getRowEvolution";
        $this->requestOptions
            ->setArguments([
                "apiModule" => $apiModule,
                "apiAction" => $apiAction
            ])
            ->setMethod("API.getRowEvolution");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->api->getRowEvolution($apiModule, $apiAction);
        $this->assertEquals($this->expectedResponse, $response);
    }


}
