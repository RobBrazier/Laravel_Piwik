<?php

namespace RobBrazier\Piwik\Base;

use RobBrazier\Piwik\Query\Url;
use RobBrazier\Piwik\Request\RequestOptions;

abstract class PiwikBase {

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
     * @param RequestOptions $requestOptions
     * @return mixed
     */
    public abstract function getCustom(RequestOptions $requestOptions);

}