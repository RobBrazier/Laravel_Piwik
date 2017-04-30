<?php

namespace RobBrazier\Piwik\Module;

use Lightools\Xml\XmlLoader;
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

    public function testGetLastVisitsParsedJson() {
        ob_start();
        include(__DIR__ . '/resources/Live.getLastVisitsDetails.json');
        $this->expectedResponse = json_decode(ob_get_contents());
        ob_end_clean();
        $format = "json";
        $count = 1;
        $this->requestOptions
            ->setFormat($format)
            ->setArguments([
                "filter_limit" => $count
            ])
            ->setMethod("Live.getLastVisitsDetails");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->live->getLastVisitsDetailsParsed($count, $format)[0];
        $this->assertNotNull($response["time"]);
        $this->assertNotNull($response["title"]);
        $this->assertNotNull($response["link"]);
        $this->assertNotNull($response["provider"]);
        $this->assertNotNull($response["country"]);
        $this->assertNotNull($response["country_icon"]);
        $this->assertNotNull($response["os"]);
        $this->assertNotNull($response["os_icon"]);
        $this->assertNotNull($response["browser"]);
        $this->assertNotNull($response["browser_icon"]);
    }

    public function testGetLastVisitsParsedPhp() {
        ob_start();
        include(__DIR__ . '/resources/Live.getLastVisitsDetails.php');
        $this->expectedResponse = unserialize(ob_get_contents());
        ob_end_clean();
        $format = "php";
        $count = 1;
        $this->requestOptions
            ->setFormat($format)
            ->setArguments([
                "filter_limit" => $count
            ])
            ->setMethod("Live.getLastVisitsDetails");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->live->getLastVisitsDetailsParsed($count, $format)[0];
        $this->assertNotNull($response["time"]);
        $this->assertNotNull($response["title"]);
        $this->assertNotNull($response["link"]);
        $this->assertNotNull($response["provider"]);
        $this->assertNotNull($response["country"]);
        $this->assertNotNull($response["country_icon"]);
        $this->assertNotNull($response["os"]);
        $this->assertNotNull($response["os_icon"]);
        $this->assertNotNull($response["browser"]);
        $this->assertNotNull($response["browser_icon"]);
    }

    public function testGetLastVisitsParsedXml() {
        ob_start();
        include(__DIR__ . '/resources/Live.getLastVisitsDetails.xml');
        $loader = new XmlLoader();
        $contents = ob_get_contents();
        $this->expectedResponse = simplexml_import_dom($loader->loadXml($contents));
        ob_end_clean();
        print_r($contents);
        $format = "xml";
        $count = 1;
        $this->requestOptions
            ->setFormat($format)
            ->setArguments([
                "filter_limit" => $count
            ])
            ->setMethod("Live.getLastVisitsDetails");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->live->getLastVisitsDetailsParsed($count, $format)[0];
        $this->assertNotNull($response["time"]);
        $this->assertNotNull($response["title"]);
        $this->assertNotNull($response["link"]);
        $this->assertNotNull($response["provider"]);
        $this->assertNotNull($response["country"]);
        $this->assertNotNull($response["country_icon"]);
        $this->assertNotNull($response["os"]);
        $this->assertNotNull($response["os_icon"]);
        $this->assertNotNull($response["browser"]);
        $this->assertNotNull($response["browser_icon"]);
    }

    /**
     * @expectedException \RobBrazier\Piwik\Exception\PiwikException
     * @expectedExceptionMessage Format [rss] is not yet supported.
     */
    public function testGetLastVisitsParsedRss() {
        $format = "rss";
        $count = 1;
        $this->requestOptions
            ->setFormat($format)
            ->setArguments([
                "filter_limit" => $count
            ])
            ->setMethod("Live.getLastVisitsDetails");
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $this->live->getLastVisitsDetailsParsed($count, $format);
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
