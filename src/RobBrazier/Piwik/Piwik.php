<?php

namespace RobBrazier\Piwik;

use RobBrazier\Piwik\Base\PiwikBase;
use RobBrazier\Piwik\Config\Option;
use RobBrazier\Piwik\Config\Options;
use RobBrazier\Piwik\Exception\PiwikException;
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
use RobBrazier\Piwik\Request\RequestOptions;

/**
 * Class Piwik
 * @package RobBrazier\Piwik
 */
class Piwik extends PiwikBase {

    /**
     * @param Options $options
     */
    public function __construct($options = null) {
        date_default_timezone_set("UTC");
        if (!is_null($options)) {
            parent::__construct($options);
        } else {
            parent::__construct(new Options());
        }

    }

    public function getActions() {
        return new ActionsModule($this);
    }

    public function getAPI() {
        return new APIModule($this);
    }

    public function getEvents() {
        return new EventsModule($this);
    }

    public function getLive() {
        return new LiveModule($this);
    }

    public function getProvider() {
        return new ProviderModule($this);
    }

    public function getReferrers() {
        return new ReferrersModule($this);
    }

    public function getSEO() {
        return new SEOModule($this);
    }

    public function getSitesManager() {
        return new SitesManagerModule($this);
    }

    public function getVisitorInterest() {
        return new VisitorInterestModule($this);
    }

    public function getVisitsSummary() {
        return new VisitsSummaryModule($this);
    }

    /**
     * tag
     * Get javascript tag for use in tracking the website
     *
     * @access  public
     * @return  string
     */

    public function getTag() {
        $piwik_url = $this->getConfig(Option::PIWIK_URL);
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
        $url = 'index.php';
        $url .= $requestOptions->build($this);
        $format = $requestOptions->getFormat($this);
        return $this->get_decoded($url, $format);
    }

    /**
     * actions
     * Get actions (hits) for the specific time period
     *
     * @deprecated Please use {@link RobBrazier\Piwik\Module\VisitsSummaryModule::getActions} instead
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function actions($format = null) {
        return $this->getVisitsSummary()->getActions([], $format);
    }

    /**
     * downloads
     * Get file downloads for the specific time period
     *
     * @deprecated
     * @param   $format string           Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function downloads($format = null) {
        return $this->getActions()->getDownloads([], $format);
    }

    /**
     * keywords
     * Get search keywords for the specific time period
     *
     * @deprecated
     * @param   $format string           Override string for the format of the API Query to be returned as
     * @return  mixed
     */
    public function keywords($format = null) {
        return $this->getReferrers()->getKeywords([], $format);
    }

    public function last_visits($count, $format = null) {
        return $this->getLive()->getLastVisitsDetails($count, [], $format);
    }

    public function last_visits_parsed($count, $format = null) {
        return $this->getLive()->getLastVisitsDetailsParsed($count, [], $format);
    }

    public function outlinks($format = null) {
        return $this->getActions()->getOutlinks([], $format);
    }

    public function page_titles($format = null) {
        return $this->getActions()->getPageTitles([], $format);
    }

    public function search_engines($format = null) {
        return $this->getReferrers()->getSearchEngines([], $format);
    }

    public function unique_visitors($format = null) {
        return $this->getVisitsSummary()->getUniqueVisitors([], $format);
    }

    public function visits($format = null) {
        return $this->getVisitsSummary()->getVisits([], $format);
    }

    public function websites($format = null) {
        return $this->getReferrers()->getWebsites([], $format);
    }

    public function seo_rank($siteId, $format = null) {
        return $this->getSEO()->getRankFromSiteId($siteId, $format);
    }

    public function custom($method, $arguments, $siteId = false, $period = false, $format = null) {
        throw new PiwikException("Piwik::custom is deprecated, please use Piwik::getCustom instead (different arguments)");
    }

}
