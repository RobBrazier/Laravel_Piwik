<?php

namespace RobBrazier\Piwik\Traits;

use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Repository\ConfigRepository;

trait ConfigTrait {

    /**
     * @var ConfigRepository
     */
    protected $config;

    /**
     * ConfigTrait constructor.
     * @param ConfigRepository $config
     */
    function __construct(ConfigRepository $config) {
        $this->config = $config;
    }

    /**
     * @param null $override
     * @return mixed
     */
    function getSiteId($override = null) {
        return $this->get(Option::SITE_ID, $override);
    }

    /**
     * @return mixed
     */
    function getPiwikUrl() {
        return $this->get(Option::PIWIK_URL, null);
    }

    /**
     * @param $key
     * @param $override
     * @return mixed
     */
    private function get($key, $override) {
        $result = $override;
        if (empty($result)) {
            $result = $this->config->get($key);
        }
        return $result;
    }

}