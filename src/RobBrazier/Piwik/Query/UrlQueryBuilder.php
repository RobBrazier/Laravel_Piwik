<?php

namespace RobBrazier\Piwik\Query;

class UrlQueryBuilder
{
    const MODULE = 'module';
    const METHOD = 'method';
    const SITE_ID = 'idSite';
    const PERIOD = 'period';
    const DATE = 'date';
    const FORMAT = 'format';
    const TOKEN_AUTH = 'token_auth';

    private $data = [];

    /**
     * @param string $module
     *
     * @return UrlQueryBuilder
     */
    public function setModule($module)
    {
        $this->add(self::MODULE, $module);

        return $this;
    }

    /**
     * @param string $method
     *
     * @return UrlQueryBuilder
     */
    public function setMethod($method)
    {
        $this->add(self::METHOD, $method);

        return $this;
    }

    /**
     * @param QueryDate $date
     *
     * @return UrlQueryBuilder
     */
    public function setDate($date)
    {
        $this->add(self::PERIOD, $date->getPeriod());
        $this->add(self::DATE, $date->getDate());

        return $this;
    }

    /**
     * @param string $siteId
     *
     * @return UrlQueryBuilder
     */
    public function setSiteId($siteId)
    {
        $this->add(self::SITE_ID, $siteId);

        return $this;
    }

    /**
     * @param string $format
     *
     * @return UrlQueryBuilder
     */
    public function setFormat($format)
    {
        $this->add(self::FORMAT, $format);

        return $this;
    }

    /**
     * @param string $tokenAuth
     *
     * @return UrlQueryBuilder
     */
    public function setTokenAuth($tokenAuth)
    {
        $this->add(self::TOKEN_AUTH, $tokenAuth);

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return UrlQueryBuilder
     */
    public function add($key, $value)
    {
        if ($value !== null) {
            $this->data[$key] = $value;
        }

        return $this;
    }

    /**
     * @param array[string]string $array
     *
     * @return UrlQueryBuilder
     */
    public function addAll($array)
    {
        foreach ($array as $key => $value) {
            $this->add($key, $value);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function build()
    {
        $separator = '';
        $result = '?';
        foreach ($this->data as $key => $value) {
            $result .= sprintf('%s%s=%s', $separator, $key, $value);
            $separator = '&';
        }

        return $result;
    }
}
