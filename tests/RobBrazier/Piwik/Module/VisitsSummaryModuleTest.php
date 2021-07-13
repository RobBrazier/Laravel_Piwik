<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class VisitsSummaryModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var VisitsSummaryModule
     */
    private $visitsSummary;

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
        $this->visitsSummary = new VisitsSummaryModule($this->request->reveal());
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
            ->setMethod('VisitsSummary.get');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->get();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetVisits()
    {
        $this->requestOptions
            ->setMethod('VisitsSummary.getVisits');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->getVisits();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetUniqueVisitors()
    {
        $this->requestOptions
            ->setMethod('VisitsSummary.getUniqueVisitors');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->getUniqueVisitors();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetUsers()
    {
        $this->requestOptions
            ->setMethod('VisitsSummary.getUsers');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->getUsers();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetActions()
    {
        $this->requestOptions
            ->setMethod('VisitsSummary.getActions');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->getActions();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetMaxActions()
    {
        $this->requestOptions
            ->setMethod('VisitsSummary.getMaxActions');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->getMaxActions();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetBounceCount()
    {
        $this->requestOptions
            ->setMethod('VisitsSummary.getBounceCount');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->getBounceCount();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetVisitsConverted()
    {
        $this->requestOptions
            ->setMethod('VisitsSummary.getVisitsConverted');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->getVisitsConverted();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSumVisitsLength()
    {
        $this->requestOptions
            ->setMethod('VisitsSummary.getSumVisitsLength');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->getSumVisitsLength();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetSumVisitsLengthPretty()
    {
        $this->requestOptions
            ->setMethod('VisitsSummary.getSumVisitsLengthPretty');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->visitsSummary->getSumVisitsLengthPretty();
        $this->assertEquals($this->expectedResponse, $response);
    }
}
