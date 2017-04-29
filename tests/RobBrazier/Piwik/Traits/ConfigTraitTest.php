<?php

namespace RobBrazier\Piwik\Traits;

use Mockery;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Repository\ConfigRepository;

class ConfigTraitTest extends TestCase {

    const EXPECTED_SITE_ID = '1';
    const EXPECTED_PIWIK_URL = 'http://piwik.example.com';

    /**
     * @var Prophet
     */
    private $prophet;

    private $configRepository;

    /**
     * @var ConfigTrait
     */
    private $configTrait;

    public function setUp() {
        $this->prophet = new Prophet();
        $this->configRepository = $this->prophet->prophesize(ConfigRepository::class);
        $this->configTrait = new ConfigTraitStub($this->configRepository->reveal());
        $this->configRepository->get(Option::SITE_ID)->willReturn(self::EXPECTED_SITE_ID);
        $this->configRepository->get(Option::PIWIK_URL)->willReturn(self::EXPECTED_PIWIK_URL);
    }

    public function testGetSiteId() {
        $siteId = $this->configTrait->getSiteId();
        $this->assertEquals(self::EXPECTED_SITE_ID, $siteId);
    }

    public function testGetSiteIdWithOverride() {
        $expected = '2';
        $siteId = $this->configTrait->getSiteId($expected);
        $this->assertEquals($expected, $siteId);
    }

    public function testGetPiwikUrl() {
        $piwikUrl = $this->configTrait->getPiwikUrl();
        $this->assertEquals(self::EXPECTED_PIWIK_URL, $piwikUrl);
    }

}

class ConfigTraitStub {
    use ConfigTrait;
}