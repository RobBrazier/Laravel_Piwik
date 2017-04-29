<?php

namespace RobBrazier\Piwik\Config;


use PHPUnit\Framework\TestCase;

class OptionsTest extends TestCase {

    /**
     * @var Options
     */
    private $options;

    public function setUp() {
        $this->options = new Options();
    }

    public function testSetPiwikUrl() {
        $piwikUrl = "http://piwik.url";
        $this->options->setPiwikUrl($piwikUrl);
        $this->assertEquals($piwikUrl, $this->options->getPiwikUrl());
    }

    public function testSetSiteId() {
        $siteId = "1";
        $this->options->setSiteId($siteId);
        $this->assertEquals($siteId, $this->options->getSiteId());
    }

    public function testSetApiKey() {
        $apiKey = "apikey";
        $this->options->setApiKey($apiKey);
        $this->assertEquals($apiKey, $this->options->getApiKey());
    }

    public function testSetFormat() {
        $format = "json";
        $this->options->setFormat($format);
        $this->assertEquals($format, $this->options->getFormat());
    }

    public function testSetPeriod() {
        $period = "yesterday";
        $this->options->setPeriod($period);
        $this->assertEquals($period, $this->options->getPeriod());
    }

}
