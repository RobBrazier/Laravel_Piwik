<?php
namespace RobBrazier\Piwik\Query;

use RobBrazier\Piwik\Query\QueryDate;

class UrlQueryBuilder {

    const MODULE = "module";
    const METHOD = "method";
    const SITE_ID = "idSite";
    const PERIOD = "period";
    const DATE = "date";
    const FORMAT = "format";
    const TOKEN_AUTH = "token_auth";

    private $data = array();

    /**
     * @param string $module
     */
    public function setModule($module) {
        $this->add(self::MODULE, $module);
    }

    /**
     * @param string $method
     */
    public function setMethod($method) {
        $this->add(self::METHOD, $method);
    }

    /**
     * @param QueryDate $date
     */
    public function setDate($date) {
        $this->add(self::PERIOD, $date->getPeriod());
        $this->add(self::DATE, $date->getDate());
    }

    /**
     * @param string $siteId
     */
    public function setSiteId($siteId) {
        $this->add(self::SITE_ID, $siteId);
    }

    /**
     * @param string $format
     */
    public function setFormat($format) {
        $this->add(self::FORMAT, $format);
    }

    /**
     * @param string $tokenAuth
     */
    public function setTokenAuth($tokenAuth) {
        $this->add(self::TOKEN_AUTH, $tokenAuth);
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function add($key, $value) {
        $this->data = array_add($this->data, $key, $value);
    }

    /**
     * @param array $array
     */
    public function addAll($array) {
        foreach ($array as $key => $value) {
            $this->add($key, $value);
        }
    }

    /**
     * @return string
     */
    public function build()
    {
        $separator = "";
        $result = "?";
        foreach ($this->data as $key => $value) {
            $result .= sprintf("%s%s=%s", $separator, $key, $value);
            $separator = "&";
        }
        return $result;
    }

}