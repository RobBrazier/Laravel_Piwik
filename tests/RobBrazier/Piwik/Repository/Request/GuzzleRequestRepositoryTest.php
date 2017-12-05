<?php

namespace RobBrazier\Piwik\Repository\Request;


use GuzzleHttp\ClientInterface;
use Lightools\Xml\XmlLoader;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Repository\ConfigRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class GuzzleRequestRepositoryTest extends TestCase
{

    /**
     * @var Prophet
     */
    private $prophet;

    /**
     * @var GuzzleRequestRepository
     */
    private $requestRepository;

    private $configRepository;
    private $client;
    private $response;
    private $stream;

    public function setUp()
    {
        $this->prophet = new Prophet();
        $this->configRepository = $this->prophet->prophesize(ConfigRepository::class);
        $this->client = $this->prophet->prophesize(ClientInterface::class);
        $this->response = $this->prophet->prophesize(ResponseInterface::class);
        $this->stream = $this->prophet->prophesize(StreamInterface::class);
        $this->requestRepository = new GuzzleRequestRepository($this->configRepository->reveal(), $this->client->reveal());
    }

    public function testSendForXml()
    {
        $response = "<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder</heading>
<body>Don't forget me this weekend!</body>
</note>";
        $this->givenConfig("xml");
        $this->givenRequest($response);
        $result = $this->whenRequestIsSent();
        $loader = new XmlLoader();
        $expected = simplexml_import_dom($loader->loadXml($response));
        $this->assertEquals($expected, $result);
    }

    public function testSendForJson()
    {
        $response = "{'foo': 'bar'}";
        $this->givenConfig("json");
        $this->givenRequest($response);
        $result = $this->whenRequestIsSent();
        $this->assertEquals(json_decode($response), $result);
    }

    public function testSendForPhp()
    {
        $response = serialize([
            "foo" => "bar"
        ]);
        $this->givenConfig("php");
        $this->givenRequest($response);
        $result = $this->whenRequestIsSent();
        $this->assertEquals(unserialize($response), $result);
    }

    private function givenConfig($format)
    {
        $this->configRepository->get(Option::API_KEY)->willReturn("apiKey");
        $this->configRepository->get(Option::FORMAT)->willReturn($format);
        $this->configRepository->get(Option::PIWIK_URL)->willReturn("http://piwik.url");
        $this->configRepository->get(Option::PERIOD)->willReturn("yesterday");
        $this->configRepository->get(Option::SITE_ID)->willReturn("1");
        $this->configRepository->get(Option::CURL_TIMEOUT, Argument::type('double'))->willReturn(5);
        $this->configRepository->get(Option::VERIFY_PEER, Argument::type('bool'))->willReturn(5);
    }

    private function givenRequest($response)
    {
        $this->client->request(Argument::type('string'), Argument::type('string'), Argument::type('array'))->willReturn($this->response->reveal());
        $this->response->getBody()->willReturn($this->stream->reveal());
        $this->stream->getContents()->willReturn($response);
    }

    private function whenRequestIsSent()
    {
        $requestOptions = new RequestOptions();
        return $this->requestRepository->send($requestOptions);
    }
}
