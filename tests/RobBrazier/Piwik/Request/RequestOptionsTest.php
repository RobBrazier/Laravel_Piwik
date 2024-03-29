<?php

namespace RobBrazier\Piwik\Request;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Repository\ConfigRepository;

class RequestOptionsTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    /**
     * @var RequestOptions
     */
    private $requestOptions;

    private $configRepository;

    public function setUp(): void
    {
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->useTokenAuth(false)
            ->useFormat(false);
        $this->prophet = new Prophet();
        $this->configRepository = $this->prophet->prophesize('RobBrazier\Piwik\Repository\ConfigRepository');
    }

    public function testSetMethod()
    {
        $method = 'methodName';
        $result = $this->requestOptions
            ->setMethod($method)
            ->build($this->configRepository->reveal());
        $this->assertStringContainsString($method, $result);
    }

    public function testUsePeriod()
    {
        $period = 'yesterday';
        $this->configRepository->get(Option::PERIOD)->willReturn($period);
        $result = $this->requestOptions
            ->usePeriod(true)
            ->build($this->configRepository->reveal());
        $this->assertStringContainsString($period, $result);
    }

    public function testSetSiteId()
    {
        $siteId = 1;
        $result = $this->requestOptions
            ->setSiteId($siteId)
            ->build($this->configRepository->reveal());
        $this->assertStringContainsString($siteId, $result);
    }

    public function testUseSiteId()
    {
        $siteId = 2;
        $this->configRepository->get(Option::SITE_ID)->willReturn($siteId);
        $result = $this->requestOptions
            ->useSiteId(true)
            ->build($this->configRepository->reveal());
        $this->assertStringContainsString($siteId, $result);
    }

    public function testSetFormat()
    {
        $format = 'json';
        $result = $this->requestOptions
            ->setFormat($format)
            ->build($this->configRepository->reveal());
        $this->assertStringContainsString($format, $result);
    }

    public function testSetNullFormat()
    {
        $result = $this->requestOptions
            ->setFormat(null)
            ->build($this->configRepository->reveal());
        $this->assertStringNotContainsString('format=', $result);
    }

    public function testUseFormat()
    {
        $format = 'xml';
        $this->configRepository->get(Option::FORMAT)->willReturn($format);
        $result = $this->requestOptions
            ->useFormat(true)
            ->build($this->configRepository->reveal());
        $this->assertStringContainsString($format, $result);
    }

    public function testUseTokenAuth()
    {
        $tokenAuth = 'apikey123';
        $this->configRepository->get(Option::API_KEY)->willReturn($tokenAuth);
        $result = $this->requestOptions
            ->useTokenAuth(true)
            ->build($this->configRepository->reveal());
        $this->assertStringContainsString($tokenAuth, $result);
    }

    public function testSetArguments()
    {
        $arguments = [
            'foo' => 'bar',
        ];
        $result = $this->requestOptions
            ->setArguments($arguments)
            ->build($this->configRepository->reveal());
        $this->assertNotEmpty($arguments);
        foreach ($arguments as $key => $value) {
            $this->assertStringContainsString("$key=$value", $result);
        }
    }

    public function testSetArgumentsWithNull()
    {
        $arguments = null;
        $result = $this->requestOptions
            ->setArguments($arguments)
            ->build($this->configRepository->reveal());
        $this->assertEquals('?module=API', $result);
    }

    public function testSetArgumentsWithSingleDimensionalArrayValue()
    {
        $url1 = 'url1';
        $url2 = 'url2';
        $arguments = [
            'url' => [
                $url1,
                $url2,
            ],
        ];
        $result = $this->requestOptions
            ->setArguments($arguments)
            ->build($this->configRepository->reveal());
        $this->assertNotEmpty($arguments);
        $this->assertEquals("?module=API&url[0]=$url1&url[1]=$url2", $result);
    }

    public function testSetArgumentsWithMultiDimensionalArrayValue()
    {
        $key1 = 'key1';
        $key2 = 'key2';
        $val1 = 'val1';
        $val2 = 'val2';
        $arguments = [
            'v' => [
                $key1 => $val1,
                $key2 => $val2,
            ],
        ];
        $result = $this->requestOptions
            ->setArguments($arguments)
            ->build($this->configRepository->reveal());
        $this->assertNotEmpty($arguments);
        $this->assertEquals("?module=API&v[$key1]=$val1&v[$key2]=$val2", $result);
    }
}
