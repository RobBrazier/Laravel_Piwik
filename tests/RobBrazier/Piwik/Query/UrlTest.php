<?php

namespace RobBrazier\Piwik\Query;

use PHPUnit\Framework\TestCase;
use RobBrazier\Piwik\Exception\PiwikException;

/**
 * Class UrlTest.
 */
class UrlTest extends TestCase
{
    private $url = 'http://localhost:8080/test';
    /**
     * @var Url
     */
    private $testClass;

    public function setUp(): void
    {
        parent::setUp();
        $this->testClass = new Url($this->url);
    }

    public function testInvalidUrl()
    {
        $this->expectException(PiwikException::class);
        $this->testClass = new Url('http:///example.com');
    }

    public function testSetScheme()
    {
        $scheme = 'https';
        $expectedUrl = str_replace('http', $scheme, $this->url);
        $this->testClass->setScheme($scheme);
        $this->assertEquals($expectedUrl, $this->testClass->__toString());
    }

    public function testSetHost()
    {
        $host = '127.0.0.1';
        $expectedUrl = str_replace('localhost', $host, $this->url);
        $this->testClass->setHost($host);
        $this->assertEquals($expectedUrl, $this->testClass->__toString());
    }

    public function testSetPort()
    {
        $port = 443;
        $expectedUrl = str_replace('8080', (string) $port, $this->url);
        $this->testClass->setPort($port);
        $this->assertEquals($expectedUrl, $this->testClass->__toString());
    }

    public function testSetPath()
    {
        $path = '/foo';
        $expectedUrl = str_replace('/test', $path, $this->url);
        $this->testClass->setPath($path);
        $this->assertEquals($expectedUrl, $this->testClass->__toString());
    }
}
