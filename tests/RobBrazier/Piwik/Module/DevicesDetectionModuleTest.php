<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class DevicesDetectionModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var DevicesDetectionModule
     */
    private $devicesDetection;

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
        $this->devicesDetection = new DevicesDetectionModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = 'foo';
    }

    public function testGetType()
    {
        $this->requestOptions
            ->setMethod('DevicesDetection.getType');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->devicesDetection->getType();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetBrand()
    {
        $this->requestOptions
            ->setMethod('DevicesDetection.getBrand');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->devicesDetection->getBrand();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetModel()
    {
        $this->requestOptions
            ->setMethod('DevicesDetection.getModel');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->devicesDetection->getModel();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetOsFamilies()
    {
        $this->requestOptions
            ->setMethod('DevicesDetection.getOsFamilies');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->devicesDetection->getOsFamilies();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetOsVersions()
    {
        $this->requestOptions
            ->setMethod('DevicesDetection.getOsVersions');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->devicesDetection->getOsVersions();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetBrowsers()
    {
        $this->requestOptions
            ->setMethod('DevicesDetection.getBrowsers');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->devicesDetection->getBrowsers();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetBrowserVersions()
    {
        $this->requestOptions
            ->setMethod('DevicesDetection.getBrowserVersions');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->devicesDetection->getBrowserVersions();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetBrowserEngines()
    {
        $this->requestOptions
            ->setMethod('DevicesDetection.getBrowserEngines');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->devicesDetection->getBrowserEngines();
        $this->assertEquals($this->expectedResponse, $response);
    }
}
