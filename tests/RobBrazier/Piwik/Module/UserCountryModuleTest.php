<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class UserCountryModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var UserCountryModule
     */
    private $userCountry;

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
        $this->userCountry = new UserCountryModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = 'foo';
    }

    public function testGetCountry()
    {
        $this->requestOptions
            ->setMethod('UserCountry.getCountry');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->userCountry->getCountry();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetContinent()
    {
        $this->requestOptions
            ->setMethod('UserCountry.getContinent');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->userCountry->getContinent();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetRegion()
    {
        $this->requestOptions
            ->setMethod('UserCountry.getRegion');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->userCountry->getRegion();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetCity()
    {
        $this->requestOptions
            ->setMethod('UserCountry.getCity');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->userCountry->getCity();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetCountryCodeMapping()
    {
        $this->requestOptions
            ->setMethod('UserCountry.getCountryCodeMapping')
            ->usePeriod(false)
            ->useSiteId(false);
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->userCountry->getCountryCodeMapping();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetLocationFromIP()
    {
        $ip = 'ip';
        $this->requestOptions
            ->setMethod('UserCountry.getLocationFromIP')
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'ip' => $ip,
            ]);
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->userCountry->getLocationFromIP($ip);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetNumberOfDistinctCountries()
    {
        $this->requestOptions
            ->setMethod('UserCountry.getNumberOfDistinctCountries');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->userCountry->getNumberOfDistinctCountries();
        $this->assertEquals($this->expectedResponse, $response);
    }
}
