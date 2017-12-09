<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class ProviderModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var ProviderModule
     */
    private $provider;

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
        $this->provider = new ProviderModule($this->request->reveal());
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
        $this->requestOptions
            ->setMethod('Provider.getProvider');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->provider->getProvider();
        $this->assertEquals($this->expectedResponse, $response);
    }
}
