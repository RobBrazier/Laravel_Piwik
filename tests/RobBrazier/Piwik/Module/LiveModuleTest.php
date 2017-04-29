<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class LiveModuleTest extends TestCase {
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var LiveModule
     */
    private $live;

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
        $this->live = new LiveModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = "foo";
    }

    public function testGetCounters() {
        $lastMinutes = 5;
        $this->requestOptions
            ->setArguments([
                "lastMinutes" => $lastMinutes
            ])
            ->setMethod("Live.getCounters");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->live->getCounters($lastMinutes);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetLastVisitsDetails() {
        $count = 5;
        $this->requestOptions
            ->setArguments([
                "filter_limit" => $count
            ])
            ->setMethod("Live.getLastVisitsDetails");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->live->getLastVisitsDetails($count);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetVisitorProfile() {
        $visitorId = "10001";
        $this->requestOptions
            ->setArguments([
                "visitorId" => $visitorId
            ])
            ->setMethod("Live.getVisitorProfile");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->live->getVisitorProfile($visitorId);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetMostRecentVisitorId() {
        $this->requestOptions
            ->usePeriod(false)
            ->setMethod("Live.getMostRecentVisitorId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->live->getMostRecentVisitorId();
        $this->assertEquals($this->expectedResponse, $response);
    }

}
