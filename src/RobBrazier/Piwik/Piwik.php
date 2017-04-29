<?php

namespace RobBrazier\Piwik;

use RobBrazier\Piwik\Base\PiwikBase;
use RobBrazier\Piwik\Module\ActionsModule;
use RobBrazier\Piwik\Module\APIModule;
use RobBrazier\Piwik\Module\EventsModule;
use RobBrazier\Piwik\Module\LiveModule;
use RobBrazier\Piwik\Module\ProviderModule;
use RobBrazier\Piwik\Module\ReferrersModule;
use RobBrazier\Piwik\Module\SEOModule;
use RobBrazier\Piwik\Module\SitesManagerModule;
use RobBrazier\Piwik\Module\VisitorInterestModule;
use RobBrazier\Piwik\Module\VisitsSummaryModule;
use RobBrazier\Piwik\Query\Url;
use RobBrazier\Piwik\Repository\ConfigRepository;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;
use RobBrazier\Piwik\Traits\ConfigTrait;

/**
 * Class Piwik
 * @package RobBrazier\Piwik
 */
class Piwik {

    use ConfigTrait {
        ConfigTrait::__construct as private __configConstruct;
    }

    /**
     * @var RequestRepository
     */
    private $request;

    /**
     * Piwik constructor.
     * @param ConfigRepository $config
     * @param RequestRepository $request
     */
    public function __construct(ConfigRepository $config, RequestRepository $request) {
        $this->__configConstruct($config);
        $this->request = $request;
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
     * @return ActionsModule
     */
    public function getActions() {
        return new ActionsModule($this->request);
    }

    /**
     * @return APIModule
     */
    public function getAPI() {
        return new APIModule($this->request);
    }

    /**
     * @return EventsModule
     */
    public function getEvents() {
        return new EventsModule($this->request);
    }

    /**
     * @return LiveModule
     */
    public function getLive() {
        return new LiveModule($this->request);
    }

    /**
     * @return ProviderModule
     */
    public function getProvider() {
        return new ProviderModule($this->request);
    }

    /**
     * @return ReferrersModule
     */
    public function getReferrers() {
        return new ReferrersModule($this->request);
    }

    /**
     * @return SEOModule
     */
    public function getSEO() {
        return new SEOModule($this->request, $this->getSitesManager());
    }

    /**
     * @return SitesManagerModule
     */
    public function getSitesManager() {
        return new SitesManagerModule($this->request);
    }

    /**
     * @return VisitorInterestModule
     */
    public function getVisitorInterest() {
        return new VisitorInterestModule($this->request);
    }

    /**
     * @return VisitsSummaryModule
     */
    public function getVisitsSummary() {
        return new VisitsSummaryModule($this->request);
    }

    /**
     * Get javascript tag for use in tracking the website
     *
     * @return  string
     */

    public function getTag() {
        $piwik_url = $this->getPiwikUrl();
        $tag = sprintf("<!-- Piwik -->
<script type=\"text/javascript\">
var _paq = _paq || [];
(function(){ var u=((\"https:\" == document.location.protocol) ? \"%s/\" : \"%s/\");
_paq.push(['setSiteId', %s]);
_paq.push(['setTrackerUrl', u+'piwik.php']);
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript'; g.defer=true; g.async=true; g.src=u+'piwik.js';
s.parentNode.insertBefore(g,s); })();
</script>
<!-- End Piwik Code -->",
            $this->convertUrl($piwik_url, true),
            $this->convertUrl($piwik_url, false),
            $this->getSiteId());

        return $tag;
    }

    /**
     * @param RequestOptions $requestOptions
     * @return mixed
     */
    public function getCustom(RequestOptions $requestOptions) {
        return $this->request->send($requestOptions);
    }

    /**
     * Get actions (hits) for the specific time period
     *
     * @deprecated
     * @see VisitsSummaryModule::getActions()
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function actions($format = null) {
        return $this->getVisitsSummary()->getActions([], $format);
    }

    /**
     * Get file downloads for the specific time period
     *
     * @deprecated
     * @see ActionsModule::getDownloads()
     * @param   string $format           Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function downloads($format = null) {
        return $this->getActions()->getDownloads([], $format);
    }

    /**
     * Get search keywords for the specific time period
     *
     * @deprecated
     * @see ReferrersModule::getKeywords()
     * @param   string $format           Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function keywords($format = null) {
        return $this->getReferrers()->getKeywords([], $format);
    }

    /**
     * Get information about last 10 visits (ip, time, country, pages, etc.)
     *
     * @deprecated
     * @see LiveModule::getLastVisitsDetails()
     * @param   int $count          Limit the number of visits returned by $count
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function last_visits($count, $format = null) {
        return $this->getLive()->getLastVisitsDetails($count, [], $format);
    }

    /**
     * Get information about last 10 visits (ip, time, country, pages, etc.) in a formatted array with GeoIP information if enabled
     *
     * @deprecated
     * @param   int $count          Limit the number of visits returned by $count
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function last_visits_parsed($count, $format = null) {
        return $this->getLive()->getLastVisitsDetailsParsed($count, $format);
    }

    /**
     * Get outlinks for the specific time period
     *
     * @deprecated
     * @see ActionsModule::getOutlinks()
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function outlinks($format = null) {
        return $this->getActions()->getOutlinks([], $format);
    }

    /**
     * Get page visit information for the specific time period
     *
     * @deprecated
     * @see ActionsModule::getPageTitles()
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return  mixed
     */

    public function page_titles($format = null) {
        return $this->getActions()->getPageTitles([], $format);
    }

    /**
     * Get search engine referer information for the specific time period
     *
     * @deprecated
     * @see ReferrersModule::getSearchEngines()
     * @param   string $format         Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function search_engines($format = null) {
        return $this->getReferrers()->getSearchEngines([], $format);
    }

    /**
     * Get unique visitors for the specific time period
     *
     * @deprecated
     * @see VisitsSummaryModule::getUniqueVisitors()
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function unique_visitors($format = null) {
        return $this->getVisitsSummary()->getUniqueVisitors([], $format);
    }

    /**
     * Get all visits for the specific time period
     *
     * @deprecated
     * @see VisitsSummaryModule::getVisits()
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function visits($format = null) {
        return $this->getVisitsSummary()->getVisits([], $format);
    }

    /**
     * Get referring websites (traffic sources) for the specific time period
     *
     * @deprecated
     * @see ReferrersModule::getWebsites()
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function websites($format = null) {
        return $this->getReferrers()->getWebsites([], $format);
    }

    /**
     * Get SEO Rank for the website
     *
     * @deprecated
     * @see SEOModule::getRankFromSiteId()
     * @param   string $siteId          Override for ID, so you can specify one rather than fetching it from config
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return mixed
     */
    public function seo_rank($siteId, $format = null) {
        return $this->getSEO()->getRankFromSiteId($siteId, $format);
    }

    /**
     * Get javascript tag for use in tracking the website
     *
     * @deprecated
     * @see Piwik::getTag()
     * @return  string
     */
    public function tag() {
        return $this->getTag();
    }


    /**
     * Get Version of the Piwik Server
     *
     * @deprecated
     * @see APIModule::getPiwikVersion()
     * @param   string $format      Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function version($format = null) {
        return $this->getAPI()->getPiwikVersion($format);
    }

}
