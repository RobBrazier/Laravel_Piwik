<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Base\PiwikBase;

/**
 * Class SEOModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#SEO for arguments
 */
class SEOModule extends Module {

    public function __construct(PiwikBase $base) {
        parent::__construct($base);
    }

    /**
     * @param string $url
     * @param string|null $format
     * @return mixed
     */
    public function getRank($url, $format = null) {
        $arguments = [
            "url" => $url
        ];
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    public function getRankFromSiteId($siteId, $format = null) {
        $url = $this->base->getSiteUrl($siteId);
        return $this->getRank($url, $format);
    }

}