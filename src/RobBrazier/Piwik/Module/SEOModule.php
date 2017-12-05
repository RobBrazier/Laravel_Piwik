<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Repository\RequestRepository;

/**
 * Class SEOModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#SEO for arguments
 */
class SEOModule extends Module
{

    /**
     * @var SitesManagerModule
     */
    private $sitesManager;

    /**
     * SEOModule constructor.
     * @param RequestRepository $request
     * @param SitesManagerModule $sitesManager
     */
    public function __construct($request, $sitesManager)
    {
        parent::__construct($request);
        $this->sitesManager = $sitesManager;
    }

    /**
     * @param string $url
     * @param string $format
     * @return mixed
     */
    public function getRank($url, $format = null)
    {
        $arguments = [
            "url" => $url
        ];
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param int $siteId
     * @param string $format
     * @return mixed
     */
    public function getRankFromSiteId($siteId, $format = null)
    {
        $url = $this->sitesManager->getSiteUrlsFromId($siteId)[0];
        return $this->getRank($url, $format);
    }

}