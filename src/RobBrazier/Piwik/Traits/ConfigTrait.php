<?php

namespace RobBrazier\Piwik\Traits;

use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Repository\ConfigRepository;

trait ConfigTrait
{

    /**
     * @var ConfigRepository
     */
    protected $config;

    /**
     * ConfigTrait constructor.
     * @param ConfigRepository $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Retrieve Site ID from configuration
     *
     * @return string site id retrieved from configuration
     */
    public function getSiteId()
    {
        return $this->get(Option::SITE_ID);
    }

    /**
     * Retrieve Piwik URL from configuration
     *
     * @return string piwik url retrieved from configuration
     */
    public function getPiwikUrl()
    {
        return $this->get(Option::PIWIK_URL);
    }

    /**
     * @param string $key key of item to retrieve from configuration
     * @return mixed
     */
    private function get($key)
    {
        return $this->config->get($key);
    }

}
