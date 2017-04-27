<?php

namespace RobBrazier\Piwik\Base;

use GuzzleHttp\Client;
use RobBrazier\Piwik\Exception\PiwikException;
use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Config\Options;
use RobBrazier\Piwik\Query\QueryDate;
use RobBrazier\Piwik\Query\QueryDates;
use RobBrazier\Piwik\Query\Url;
use RobBrazier\Piwik\Request\RequestOptions;

abstract class PiwikBase {

    /**
     * Allowed Response formats
     * @var array
     */
    const ALLOWED_FORMATS = ["json", "php", "xml", "html", "rss", "original"];

    /**
     * @var Options
     */
    protected $options;

    protected function __construct($options) {
        $this->options = $options;
    }

    public function getApiKey() {
        $username = $this->getConfig(Option::USERNAME);
        $password = $this->getPassword();
        $result = $this->getConfig(Option::API_KEY);
        if (empty($result) && !empty($username) && !empty($password)) {
            $arguments = ["userLogin" => $username, "md5Password" => $password];
            $requestOptions = new RequestOptions();
            $requestOptions
                ->setMethod("UsersManager.getTokenAuth")
                ->useSiteId(false)
                ->usePeriod(false)
                ->useFormat(false)
                ->useTokenAuth(false)
                ->setArguments($arguments);

            $apiKey = $this->getCustom($requestOptions);
            $this->options->setApiKey($apiKey);
            $result = $apiKey;
        } else if (empty($result)) {
            throw new PiwikException("Unable to retrieve API Key from the provided credentials");
        }
        return $result;
    }

    /**
     * Get Site URL from Site ID
     *
     * @param string $siteId
     * @return string
     */
    public function getSiteUrl($siteId) {
        $requestOptions = new RequestOptions();
        $requestOptions
            ->setMethod("SitesManager.getSiteUrlsFromId")
            ->setSiteId($siteId)
            ->setFormat("json");
        return $this->getCustom($requestOptions)[0];
    }

    /**
     * Get QueryDate object from period name
     *
     * e.g. "yesterday" => QueryDate(period = "day", date = "yesterday")
     *
     * @param string $period
     * @return QueryDate
     */
    public function getDate($period) {
        return QueryDates::getInstance()->get($period);
    }

    /**
     * Convert URL from HTTP to HTTPS and vice versa
     *
     * @param string $url
     * @param bool $https
     * @return string
     */
    protected function convertUrl($url, $https) {
        $scheme = ($https) ? 'https' : 'http';
        $parser = new Url($url);
        $parser->setScheme($scheme);
        return $parser->__toString();
    }

    /**
     * Check format against allowed values
     *
     * @param string $format
     * @return string
     */
    public function getFormat($format = null) {
        if ($format === null) {
            $format = $this->getConfig(Option::FORMAT);
        }
        if (!in_array($format, self::ALLOWED_FORMATS)) {
            throw new PiwikException("Invalid format [" . $format . "]");
        }
        return $format;
    }

    /**
     * Retrieve password from config
     *
     * - If it is already md5 hashed, return the pre-hashed value
     * - If it is not md5 hashed, hash and return the hashed value
     *
     * @return string
     */
    protected function getPassword() {
        $password = $this->getConfig(Option::PASSWORD);
        if (!$this->isMd5($password)) {
            $password = md5($password);
        }
        return $password;
    }

    /**
     * @param $md5
     * @return bool
     */
    private function isMd5($md5) {
        return preg_match('/^[a-f0-9]{32}$/', $md5) != 0;
    }

    /**
     * Get configuration item from
     *  1. Current class instance (if specified in constructor)
     *  2. piwik.php configuration file
     *
     * @param string $key
     * @return mixed
     */
    public function getConfig($key) {
        $method = 'get' . ucfirst($key);
        $result = $this->options->$method();
        if ($result == null) {
            $configKey = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));
            $result = config('piwik.' . $configKey);
        }
        return $result;
    }

    /**
     * Get Site ID
     *
     * @param string $siteId
     * @return string
     */
    public function getSiteId($siteId = null) {
        $result = $siteId;
        if (empty($result)) {
            $result = $this->getConfig(Option::SITE_ID);
        }
        return $result;
    }

    /**
     * Send HTTP/HTTPS request to Piwik server
     *
     * @param   $url string            the url to send a request to
     * @return  string
     */
    protected function request($url) {
        $client = new Client([
            "timeout" => config('piwik.curl_timeout', 5.0),
            "verify" => config('piwik.verify_peer', true),
            "base_uri" => $this->getConfig(Option::PIWIK_URL)
        ]);
        $response = $client->get($url);
        $body = $response->getBody();
        return $body->getContents();
    }

    /**
     * get_decoded
     * Decode the format to usable PHP arrays/objects
     *
     * @access  private
     * @param   $url string         URL to decode (declared within other functions)
     * @param   $format string
     * @return  mixed
     */

    protected function get_decoded($url, $format) {
        $result = $this->request($url);
        switch ($this->getFormat($format)) {
            case 'json':
                $result = json_decode($result);
                break;
            case 'php':
                $result = unserialize($result);
                break;
        }
        return $result;
    }

    /**
     * @param RequestOptions $requestOptions
     * @return mixed
     */
    public abstract function getCustom(RequestOptions $requestOptions);

}