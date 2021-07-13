<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class ContentsModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var ContentsModule
     */
    private $contents;

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
        $this->contents = new ContentsModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = 'foo';
    }

    public function testGetContentNames()
    {
        $this->requestOptions
            ->setMethod('Contents.getContentNames');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->contents->getContentNames();
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testGetContentPieces()
    {
        $this->requestOptions
            ->setMethod('Contents.getContentPieces');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->contents->getContentPieces();
        $this->assertEquals($this->expectedResponse, $response);
    }
}
