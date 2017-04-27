<?php

namespace RobBrazier\Piwik\Request;

use RobBrazier\Piwik\Base\PiwikBase;
use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Query\UrlQueryBuilder;

class RequestOptions {

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $siteId;

    /**
     * @var string
     */
    private $format;

    /**
     * Determines whether the period in the config file is used in the request
     *
     * @var bool
     */
    private $usePeriod = true;

    /**
     * Determines whether the site id in the config file is used in the request
     *
     * @var bool
     */
    private $useSiteId = true;

    /**
     * Determines whether the format in the config file is used in the request
     *
     * @var bool
     */
    private $useFormat = true;

    /**
     * @var bool
     */
    private $tokenAuth = true;

    /**
     * @var array
     */
    private $arguments = [];

    /**
     * RequestOptions constructor.
     */
    public function __construct() {
        return $this;
    }

    /**
     * @param string $method
     * @return RequestOptions
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param bool $period
     * @return RequestOptions
     */
    public function usePeriod($period)
    {
        $this->usePeriod = $period;
        return $this;
    }

    /**
     * @param string $siteId
     * @return RequestOptions
     */
    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;
        $this->useSiteId(false);
        return $this;
    }

    /**
     * @param bool $siteId
     * @return RequestOptions
     */
    public function useSiteId($siteId) {
        $this->useSiteId = $siteId;
        return $this;
    }

    /**
     * @param PiwikBase $parent
     * @return string
     */
    private function getSiteId(PiwikBase $parent) {
        $siteId = $this->siteId;
        if ($this->useSiteId) {
            $siteId = $parent->getSiteId();
        }
        return $siteId;
    }

    /**
     * @param string $format
     * @return RequestOptions
     */
    public function setFormat($format)
    {
        if (!is_null($format)) {
            $this->format = $format;
            $this->useFormat(false);
        }
        return $this;
    }

    /**
     * @param bool $format
     * @return RequestOptions
     */
    public function useFormat($format) {
        $this->useFormat = $format;
        return $this;
    }

    /**
     * @param PiwikBase $parent
     * @return string
     */
    public function getFormat(PiwikBase $parent) {
        $format = $this->format;
        if ($this->useFormat) {
            $format = $parent->getConfig(Option::FORMAT);
        }
        return $parent->getFormat($format);
    }

    /**
     * @param bool $tokenAuth
     * @return RequestOptions
     */
    public function useTokenAuth($tokenAuth) {
        $this->tokenAuth = $tokenAuth;
        return $this;
    }

    /**
     * @param PiwikBase $parent
     * @return string|null
     */
    private function getTokenAuth(PiwikBase $parent) {
        $tokenAuth = null;
        if ($this->tokenAuth) {
            $tokenAuth = $parent->getApiKey();
        }
        return $tokenAuth;
    }

    /**
     * @param array $arguments
     * @return RequestOptions
     */
    public function setArguments($arguments)
    {
        if (is_null($arguments)) {
            $arguments = [];
        }
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * @param PiwikBase $parent
     * @return string
     */
    public function build(PiwikBase $parent) {
        $builder = new UrlQueryBuilder();
        $builder->setModule("API");
        $builder->setMethod($this->method);
        if ($this->usePeriod) {
            $period = $parent->getConfig(Option::PERIOD);
            $builder->setDate($parent->getDate($period));
        }
        $builder->setSiteId($this->getSiteId($parent));
        $builder->setFormat($this->getFormat($parent));
        $builder->setTokenAuth($this->getTokenAuth($parent));
        $builder->addAll($this->arguments);
        return $builder->build();
    }



}