<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class EventsModuleTest extends TestCase {

    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var EventsModule
     */
    private $events;

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
        $this->events = new EventsModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = "foo";
    }

    public function testGetCategory() {
        $this->requestOptions
            ->setMethod("Events.getCategory");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->events->getCategory();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetAction() {
        $this->requestOptions
            ->setMethod("Events.getAction");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->events->getAction();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetName() {
        $this->requestOptions
            ->setMethod("Events.getName");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->events->getName();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetActionFromCategoryId() {
        $this->requestOptions
            ->setMethod("Events.getActionFromCategoryId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->events->getActionFromCategoryId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNameFromCategoryId() {
        $this->requestOptions
            ->setMethod("Events.getNameFromCategoryId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->events->getNameFromCategoryId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetCategoryFromActionId() {
        $this->requestOptions
            ->setMethod("Events.getCategoryFromActionId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->events->getCategoryFromActionId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNameFromActionId() {
        $this->requestOptions
            ->setMethod("Events.getNameFromActionId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->events->getNameFromActionId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetActionFromNameId() {
        $this->requestOptions
            ->setMethod("Events.getActionFromNameId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->events->getActionFromNameId();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetCategoryFromNameId() {
        $this->requestOptions
            ->setMethod("Events.getCategoryFromNameId");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->events->getCategoryFromNameId();
        $this->assertEquals($this->expectedResponse, $response);
    }

}
