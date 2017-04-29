<?php

namespace RobBrazier\Piwik\Config;


class Options {

    /**
     * @var string
     */
    private $piwikUrl;

    /**
     * @var string
     */
    private $siteId;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $format;

    /**
     * @var string
     */
    private $period;

    /**
     * @return string
     */
    public function getPiwikUrl()
    {
        return $this->piwikUrl;
    }

    /**
     * @param string $piwikUrl
     */
    public function setPiwikUrl($piwikUrl)
    {
        $this->piwikUrl = $piwikUrl;
    }

    /**
     * @return string
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * @param string $siteId
     */
    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param string $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

}