<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Repository\RequestRepository;

/**
 * Class SEOModule.
 *
 * @see https://developer.matomo.org/api-reference/reporting-api#SEO for arguments
 */
class SEOModule extends Module
{
    /**
     * @var SitesManagerModule
     */
    private $sitesManager;

    /**
     * SEOModule constructor.
     *
     * @param RequestRepository  $request
     * @param SitesManagerModule $sitesManager
     */
    public function __construct($request, $sitesManager)
    {
        parent::__construct($request);
        $this->sitesManager = $sitesManager;
    }

    /**
     * @param string $url    url to search for
     * @param string $format override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getRank($url, $format = null)
    {
        $arguments = [
            'url' => $url,
        ];
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param int    $siteId Override for ID, so you can specify one rather than fetching it from config
     * @param string $format override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getRankFromSiteId($siteId, $format = null)
    {
        $url = $this->sitesManager->getSiteUrlsFromId($siteId)[0];

        return $this->getRank($url, $format);
    }
}
