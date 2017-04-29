<?php

namespace RobBrazier\Piwik\Query;
use PHPUnit\Framework\TestCase;

/**
 * Class UrlTest
 * @package RobBrazier\Piwik\Query
 * @covers \RobBrazier\Piwik\Query\Url
 */
class UrlTest extends TestCase {

    private $url = "http://localhost:8080/test";
    /**
     * @var Url
     */
    private $testClass;

    public function setUp() {
        parent::setUp();
        $this->testClass = new Url($this->url);
    }

    /**
     * @expectedException \RobBrazier\Piwik\Exception\PiwikException
     */
    public function testInvalidUrl() {
        $this->testClass = new Url("http:///example.com");
    }

    public function testSetScheme() {
        $scheme = 'https';
        $expectedUrl = str_replace('http', $scheme, $this->url);
        $this->testClass->setScheme($scheme);
        $this->assertEquals($expectedUrl, $this->testClass->__toString());
    }

    public function testSetHost() {
        $host = '127.0.0.1';
        $expectedUrl = str_replace('localhost', $host, $this->url);
        $this->testClass->setHost($host);
        $this->assertEquals($expectedUrl, $this->testClass->__toString());
    }

    public function testSetPort() {
        $port = 443;
        $expectedUrl = str_replace('8080', strval($port), $this->url);
        $this->testClass->setPort($port);
        $this->assertEquals($expectedUrl, $this->testClass->__toString());
    }

    public function testSetPath() {
        $path = '/foo';
        $expectedUrl = str_replace('/test', $path, $this->url);
        $this->testClass->setPath($path);
        $this->assertEquals($expectedUrl, $this->testClass->__toString());
    }

}
