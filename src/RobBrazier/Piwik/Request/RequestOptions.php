<?php

namespace RobBrazier\Piwik\Request;

use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Query\UrlQueryBuilder;
use RobBrazier\Piwik\Repository\ConfigRepository;
use RobBrazier\Piwik\Traits\DateTrait;
use RobBrazier\Piwik\Traits\FormatTrait;

class RequestOptions
{
    use DateTrait;
    use FormatTrait;

    /**
     * @var string
     */
    private $method;

    /**
     * @var int
     */
    private $siteId;

    /**
     * @var string
     */
    private $format;

    /**
     * Determines whether the period in the config file is used in the request.
     *
     * @var bool
     */
    private $usePeriod = true;

    /**
     * Determines whether the site id in the config file is used in the request.
     *
     * @var bool
     */
    private $useSiteId = true;

    /**
     * Determines whether the format in the config file is used in the request.
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
     * @param string $method
     *
     * @return RequestOptions
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @param bool $period
     *
     * @return RequestOptions
     */
    public function usePeriod($period)
    {
        $this->usePeriod = $period;

        return $this;
    }

    /**
     * @param int $siteId
     *
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
     *
     * @return RequestOptions
     */
    public function useSiteId($siteId)
    {
        $this->useSiteId = $siteId;

        return $this;
    }

    /**
     * @param ConfigRepository $config
     *
     * @return string
     */
    private function getSiteId($config)
    {
        $result = $this->siteId;
        if ($this->useSiteId) {
            $result = $config->get(Option::SITE_ID);
        }

        return $result;
    }

    /**
     * @param string $format
     *
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
     *
     * @return RequestOptions
     */
    public function useFormat($format)
    {
        $this->useFormat = $format;

        return $this;
    }

    /**
     * @param ConfigRepository $config
     *
     * @return string
     */
    public function getFormat($config)
    {
        $result = $this->format;
        if ($this->useFormat) {
            $result = $config->get(Option::FORMAT);
        }

        return $result;
    }

    /**
     * @param bool $tokenAuth
     *
     * @return RequestOptions
     */
    public function useTokenAuth($tokenAuth)
    {
        $this->tokenAuth = $tokenAuth;

        return $this;
    }

    /**
     * @param ConfigRepository $config
     *
     * @return string
     */
    private function getTokenAuth($config)
    {
        $result = null;
        if ($this->tokenAuth) {
            $result = $config->get(Option::API_KEY);
        }

        return $result;
    }

    /**
     * @param array[string]mixed $arguments
     *
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
     * @param array $array
     *
     * @return array
     */
    public function flattenArray($array)
    {
        $result = [];
        foreach (array_dot($array) as $key => $value) {
            $splitKey = explode('.', $key);
            $newKey = $this->createArrayKey($splitKey);
            $result = array_merge($result, [$newKey => $value]);
        }

        return $result;
    }

    private function createArrayKey($keyParts)
    {
        $result = '';
        $i = 0;
        foreach ($keyParts as $part) {
            $format = '%s';
            if ($i > 0) {
                $format = '[%s]';
            }
            $result .= sprintf($format, $part);
            $i++;
        }

        return $result;
    }

    /**
     * @param ConfigRepository $config
     *
     * @return string
     */
    public function build($config)
    {
        $builder = new UrlQueryBuilder();
        $builder->setModule('API');
        $builder->setMethod($this->method);
        if ($this->usePeriod) {
            $period = $config->get(Option::PERIOD);
            $builder->setDate($this->getDate($period));
        }
        $builder->setSiteId($this->getSiteId($config));
        $formatOverride = $this->getFormat($config);
        if (!is_null($formatOverride)) {
            $builder->setFormat($this->validateFormat($formatOverride));
        }
        $builder->setTokenAuth($this->getTokenAuth($config));
        $builder->addAll($this->flattenArray($this->arguments));

        return $builder->build();
    }
}
