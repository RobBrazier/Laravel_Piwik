<?php

namespace RobBrazier\Piwik;

use GuzzleHttp\Client;
use RobBrazier\Piwik\Query\QueryDate;
use RobBrazier\Piwik\Query\QueryDates;
use RobBrazier\Piwik\Query\Url;
use RobBrazier\Piwik\Query\UrlQueryBuilder;

/**
 * Class Piwik
 * @package RobBrazier\Piwik
 */
class Piwik {

    /**
     * Allowed Response formats
     * (Unfortunately PHP 5.5 doesn't support array constants)
     * @var array
     */
    private $allowedFormats = array("json", "php", "xml", "html", "rss", "original");
    /**
     * @var string
     */
    private $piwik_url = '';
    /**
     * @var string
     */
    private $site_id = '';
    /**
     * @var string
     */
    private $api_key = '';
    /**
     * @var string
     */
    private $username = '';
    /**
     * @var string
     */
    private $password = '';
    /**
     * @var string
     */
    private $format = '';
    /**
     * @var string
     */
    private $period = '';

    /**
     * @param array $args
     */
    public function __construct(array $args = array()) {
        date_default_timezone_set("UTC");
        if (!empty($args)) {
            $this->piwik_url = array_get($args, 'piwik_url');
            $this->site_id = array_get($args, 'site_id');
            $this->api_key = array_get($args, 'apikey');
            $this->username = array_get($args, 'username');
            $this->password = array_get($args, 'password');
            $this->format = array_get($args, 'format');
            $this->period = array_get($args, 'period');
        }

    }

// ====================================================================
//
// CHECKERS & GETTERS - Check the config file and retrieve the contents
//
// --------------------------------------------------------------------

    /**
     * @param string $period
     * @return QueryDate
     */
    private function getDate($period) {
        return QueryDates::getInstance()->get($period);
    }

    /**
     * @param string $url
     * @param bool $https
     * @return string
     */
    private function convertUrl($url, $https) {
        $scheme = ($https) ? 'https' : 'http';
        $parser = new Url($url);
        $parser->setScheme($scheme);
        return $parser->__toString();
    }

    private function getFormat($format) {
        if ($format == null) {
            $format = $this->getConfig('format');
        }
        if (!in_array($format, $this->allowedFormats)) {
            throw new PiwikException("Invalid format [" . $format . "]");
        }
        return $format;
    }

    private function getApiKey() {
        $apikey = $this->getConfig('api_key');
        $username = $this->getConfig('username');
        $password = md5($this->getConfig('password'));
        $result = $apikey;
        if (empty($result) && !empty($username) && !empty($password)) {
            $arguments = array("userLogin" => $this->username, "md5Password" => $this->password);
            $this->api_key = $this->custom("UsersManager.getTokenAuth", $arguments, false, false, null);
            $result = $this->api_key;
        } else if (empty($result)) {
            throw new PiwikException("Unable to retrieve API Key from the provided credentials");
        }
        return $result;
    }

    /**
     * @param string $key
     * @return mixed
     */
    private function getConfig($key) {
        $result = $this->$key;
        if ($this->$key == null) {
            $result = config('piwik.' . $key);
        }
        return $result;
    }

    private function getSiteId($override = null) {
        $result = $override;
        if (empty($result)) {
            $result = $this->getConfig('site_id');
        }
        return $result;
    }

    private function getSiteUrl($id = null) {
        return $this->custom("SitesManager.getSiteUrlsFromId", null, $id, true, "json")[0];
    }

    /**
     * @param   $url string            the url to send a request to
     * @return  string
     */
    private function request($url) {
        $client = new Client(array(
            "timeout" => config('piwik.curl_timeout', 5.0),
            "verify" => config('piwik.verify_peer', true),
            "base_uri" => $this->getConfig('piwik_url')
        ));
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

    private function get_decoded($url, $format) {
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

// ====================================================================
//
// API Queries
//
// --------------------------------------------------------------------

    /**
     * actions
     * Get actions (hits) for the specific time period
     *
     * @access  public
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  object
     */
    public function actions($format = null) {
        return $this->custom("VisitsSummary.getActions", null, true, true, $format);
    }

    /**
     * downloads
     * Get file downloads for the specific time period
     *
     * @access  public
     * @param   $format string           Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function downloads($format = null) {
        return $this->custom("Actions.getDownloads", null, true, true, $format);
    }

    /**
     * keywords
     * Get search keywords for the specific time period
     *
     * @access  public
     * @param   $format string           Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function keywords($format = null) {
        return $this->custom("Referers.getKeywords", null, true, true, $format);
    }

    /**
     * last_visits
     * Get information about last 10 visits (ip, time, country, pages, etc.)
     *
     * @access  public
     * @param   $count int          Limit the number of visits returned by $count
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function last_visits($count, $format = null) {
        $arguments = array("filter_limit" => $count);
        return $this->custom("Live.getLastVisitsDetails", $arguments, true, true, $format);
    }

    /**
     * last_visits_parsed
     * Get information about last 10 visits (ip, time, country, pages, etc.) in a formatted array with GeoIP information if enabled
     *
     * @access  public
     * @param   $count int          Limit the number of visits returned by $count
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function last_visits_parsed($count, $format = null) {
        $arguments = array("filter_limit" => $count);
        $visits = $this->custom("Live.getLastVisitsDetails", $arguments, true, true, $format);

        $data = array();
        foreach ($visits as $v) {
            // Get the last array element which has information of the last page the visitor accessed
            switch ($this->getFormat($format)) {
                case 'json':
                    // no break as the logic is the same as in the php case, but with an object to array conversion
                    $v = (array) $v;
                case 'php':
                    $actionDetails = (array) array_get($v, 'actionDetails');
                    $count = count($actionDetails) - 1;
                    $actionDetail = (array) array_get($actionDetails, $count);
                    $page_link = array_get($actionDetail, 'url');
                    $page_title = array_get($actionDetail, 'pageTitle');

                    // Get just the image names (API returns path to icons in piwik install)
                    $flag = explode('/', array_get($v, 'countryFlag'));
                    $flag_icon = end($flag);

                    $os = explode('/', array_get($v, 'operatingSystemIcon'));
                    $os_icon = end($os);

                    $browser = explode('/', array_get($v, 'browserIcon'));
                    $browser_icon = end($browser);

                    $data[] = array(
                        'time' => date("M j Y, g:i a", array_get($v, 'lastActionTimestamp')),
                        'title' => $page_title,
                        'link' => $page_link,
                        'ip_address' => array_get($v, 'visitIp'),
                        'provider' => array_get($v, 'provider'),
                        'country' => array_get($v, 'country'),
                        'country_icon' => $flag_icon,
                        'os' => array_get($v, 'operatingSystem'),
                        'os_icon' => $os_icon,
                        'browser' => array_get($v, 'browserName'),
                        'browser_icon' => $browser_icon,
                    );
                    break;
                default:
                    throw new PiwikException("Format [" . $format . "] is not yet supported.");
            }

        }
        return $data;
    }

    /**
     * actions
     * Get outlinks for the specific time period
     *
     * @access  public
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function outlinks($format = null) {
        return $this->custom("Actions.getOutlinks", null, true, true, $format);
    }

    /**
     * page_titles
     * Get page visit information for the specific time period
     *
     * @access  public
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function page_titles($format = null) {
        return $this->custom("Actions.getPageTitles", null, true, true, $format);
    }

    /**
     * search_engines
     * Get search engine referer information for the specific time period
     *
     * @access  public
     * @param   $format string         Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function search_engines($format = null) {
        return $this->custom("Referers.getSearchEngines", null, true, true, $format);
    }

    /**
     * unique_visitors
     * Get unique visitors for the specific time period
     *
     * @access  public
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function unique_visitors($format = null) {
        return $this->custom("VisitsSummary.getUniqueVisitors", null, true, true, $format);
    }

    /**
     * visits
     * Get all visits for the specific time period
     *
     * @access  public
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function visits($format = null) {
        return $this->custom("VisitsSummary.getVisits", null, true, true, $format);
    }

    /**
     * websites
     * Get refering websites (traffic sources) for the specific time period
     *
     * @access  public
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function websites($format = null) {
        return $this->custom("Referers.getWebsites", null, true, true, $format);
    }

    /**
     * tag
     * Get javascript tag for use in tracking the website
     *
     * Note: Works best when using PHP as the format
     *
     * @access  public
     * @return  string
     */

    public function tag() {
        $piwik_url = $this->getConfig('piwik_url');
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
<!-- End Piwik Code -->", $this->convertUrl($piwik_url, true), $this->convertUrl($piwik_url, false), $this->getSiteId());

        return $tag;
    }

    /**
     * seo_rank
     * Get SEO Rank for the website
     *
     * @access  public
     * @param   $id string          Override for ID, so you can specify one rather than fetching it from config
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return array
     */

    public function seo_rank($id, $format = null) {
        $arguments = array("url" => $this->getSiteUrl($id));
        return $this->custom("SEO.getRank", $arguments, false, false, $format);
    }

    /**
     * version
     * Get Version of the Piwik Server
     *
     * @access  public
     * @param   $format string      Override string for the format of the API Query to be returned as
     * @return  mixed
     */

    public function version($format = null) {
        return $this->custom("API.getPiwikVersion", null, false, false, $format);
    }

    /**
     * @param $method string        The API method, as found in the Piwik API documentation
     * @param $arguments array|null A multidimensional map of key => value for custom data to be added onto the url, e.g. ["test" => "foo"] ===> &test=foo
     * @param $id string|bool       values can be true/false to add the default site id, or you can specify the id here
     * @param $period bool          boolean value to determine whether the time period is appended to the API url
     * @param $format string        Override string for the format of the API Query to be returned as
     * @return mixed
     */
    public function custom($method, $arguments, $id = false, $period = false, $format = null) {
        $format = $this->getFormat($format);
        if ($arguments == null) {
            $arguments = array();
        }
        $url = 'index.php';
        $builder = new UrlQueryBuilder();
        $builder->setModule("API");
        $builder->setMethod($method);
        $builder->addAll($arguments);
        if ($id != null || (is_bool($id) && $id)) {
            $override_id = null;
            if (!is_bool($id)) {
                $override_id = $id;
            }
            $siteId = $this->getSiteId($override_id);
            $builder->setSiteId($siteId);
        }
        if ($period) {
            $date = $this->getDate($this->getConfig('period'));
            $builder->setDate($date);
        }
        $builder->setFormat($format);
        $builder->setTokenAuth($this->getApiKey());
        $url .= $builder->build();
        return $this->get_decoded($url, $format);
    }

}
