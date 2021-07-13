<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class VisitorInterestModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var VisitorInterestModule
     */
    private $visitorInterest;

    /**
     * @var RequestOptions
     */
    private $requestOptions;

    /**
     * @var string
     */
    private $expectedResponse;

    public function setUp(): void
    {
        $this->prophet = new Prophet();
        $this->request = $this->prophet->prophesize(RequestRepository::class);
        $this->visitorInterest = new VisitorInterestModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = 'foo';
    }

    public function testGetNumberOfVisitsPerVisitDuration()
    {
        $this->requestOptions
            ->setMethod('VisitorInterest.getNumberOfVisitsPerVisitDuration');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitorInterest->getNumberOfVisitsPerVisitDuration();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNumberOfVisitsPerPage()
    {
        $this->requestOptions
            ->setMethod('VisitorInterest.getNumberOfVisitsPerPage');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitorInterest->getNumberOfVisitsPerPage();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNumberOfVisitsByDaysSinceLast()
    {
        $this->requestOptions
            ->setMethod('VisitorInterest.getNumberOfVisitsByDaysSinceLast');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitorInterest->getNumberOfVisitsByDaysSinceLast();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNumberOfVisitsByVisitCount()
    {
        $this->requestOptions
            ->setMethod('VisitorInterest.getNumberOfVisitsByVisitCount');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitorInterest->getNumberOfVisitsByVisitCount();
        $this->assertEquals($this->expectedResponse, $response);
    }
}
