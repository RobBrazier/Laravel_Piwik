<?php 
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2012 Rob Brazier <rob.brazier@me.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category   Libraries
 * @package    Libraries
 * @subpackage Libraries
 * @author     Rob Brazier <rob.brazier@me.com>
 * @copyright  2014 Rob Brazier.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    2.0.0
 * @link       http://robbrazier.com
 */

namespace RobBrazier\Piwik;
use \Config;
use \Session;

/**
 * Class Piwik
 * @package RobBrazier\Piwik
 */
class Piwik {
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
    private $apikey = '';
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
     * @var bool
     */
    private $constructed = false;


    /**
     * @param $piwik_url
     * @param $site_id
     * @param $apikey
     * @param $username
     * @param $password
     * @param $format
     * @param $period
     */
    public function __construct(array $args = array()) {
        if(!empty($args)){
            $this->piwik_url = $args['piwik_url'];
            $this->site_id = $args['site_id'];
            $this->apikey = $args['apikey'];
            $this->username = $args['username'];
            $this->password = $args['password'];
            $this->format = $args['format'];
            $this->period = $args['period'];
            $this->constructed = true;
        }

    }

// ====================================================================
//
// CHECKERS & GETTERS - Check the config file and retrieve the contents
//
// --------------------------------------------------------------------
    
    /**
     * date
     * Read config for the period to make API queries about, and translate it into URL-friendly strings
     *
     * @access  private
     * @return  string
     */

    private function date() {
        $this->period = ($this->constructed) ? $this->period : Config::get('piwik::period');
        switch ($this->period) {
            case 'today':
                return '&period=day&date=today';
                break;
            
            case 'yesterday':
                return '&period=day&date=yesterday';
                break;
            
            case 'previous7':
                return '&period=range&date=previous7';
                break;
            
            case 'previous30':
                return '&period=range&date=previous30';
                break;
            
            case 'last7':
                return '&period=range&date=last7';
                break;
            
            case 'last30':
                return '&period=range&date=last30';
                break;
            
            case 'currentweek':
                return '&period=week&date=today';
                break;
            
            case 'currentmonth':
                return '&period=month&date=today';
                break;
            
            case 'currentyear':
                return '&period=year&date=today';
                break;
            
            default:
                return '&period=day&date=yesterday';
                break;
        }
    }

    /**
     * to_https
     * Convert http:// to https:// for tag generation
     *
     * @access  private
     * @return  string
     */

    private function to_https() {
        $url = $this->get_piwik_url();
        if(preg_match('/http:/', $url)){
            return str_replace('http', 'https', $url);
        } else if(preg_match('/https:/', $url)){
            return $url;
        }
    }

    /**
     * to_http
     * Check that the URL is http://
     *
     * @access  private
     * @return  string
     */

    private function to_http() {
        $url = $this->get_piwik_url();
        if(preg_match('/https:/', $url)){
            return str_replace('https', 'http', $url);
        } else if(preg_match('/http:/', $url)){
            return $url;
        }
    }

    /**
     * check_format
     * Check the format as defined in config, and default to json if it is not on the list
     *
     * @access  private
     * @param   string  $override     Override string for the format of the API Query to be returned as
     * @return  string
     */

    private function check_format($override = null) {
        if($override !== null) {
            $this->format = $override;
        } else {
            $this->format = ($this->constructed) ? $this->format : Config::get('piwik::format');
        }
        switch ($this->format) {
            case 'json':
                return 'json';
                break;
            case 'php':
                return 'php';
                break;

            case 'xml':
                return 'xml';
                break;
                
            case 'html':
                return 'html';
                break;
                    
            case 'rss':
                return 'rss';
                break;
                
            case 'original':
                return 'original';
                break;
                    
            default:
                return 'json';
                break;
        }

    }

    /**
     * get_site_id
     * Allows access to site_id from all functions
     *
     * @access  private
     * @return  string
     */

    private function get_site_id($id = null) {
        $this->site_id = ($this->constructed) ? $this->site_id : Config::get('piwik::site_id');
        if(isset($id)){
            $this->site_id = $id;
            return $this->site_id;
        } else {
            return $this->site_id;
        }
    }

    /**
     * get_apikey
     * Allows access to apikey from all functions
     *
     * @access  private
     * @return  string
     */
    
    private function get_apikey() {
        $this->apikey = ($this->constructed) ? $this->apikey : Config::get('piwik::api_key');
        $this->username = ($this->constructed) ? $this->username : Config::get('piwik::username');
        $this->password = ($this->constructed) ? $this->password : md5(Config::get('piwik::password'));

        if(empty($this->apikey) && !empty($this->username) && !empty($this->password)){
            $url = $this->get_piwik_url().'/index.php?module=API&method=UsersManager.getTokenAuth&userLogin='.$this->username.'&md5Password='.$this->password.'&format='.$this->check_format();
            if(!Session::has('apikey')) Session::put('apikey', $this->get_decoded($url));
            $this->apikey = Session::get('apikey');
            return $this->apikey->value;
        } else if(!empty($this->apikey)) {
            return $this->apikey;
        } else {
            echo '<strong style="color:red">You must enter your API Key or Username/Password combination to use this bundle!</strong><br/>';
        }
    }

    /**
     * get_piwik_url
     * Allows access to piwik_url from all functions
     *
     * @access  private
     * @return  string
     */
    
    private function get_piwik_url() {
        $this->piwik_url = ($this->constructed) ? $this->piwik_url : Config::get('piwik::piwik_url');
        return $this->piwik_url;
    }

    /**
     * @param $url
     * @return mixed
     */
    private function _get($url) {
      $ch = curl_init();
      $timeout = 5;
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
    }

    /**
     * get_decoded
     * Decode the format to usable PHP arrays/objects
     *
     * @access  private
     * @param   string  $url   URL to decode (declared within other functions)
     * @return  array
     */

    private function get_decoded($url, $format = null){
        switch ($this->check_format($format)) {
            case 'json':
                return json_decode($this->_get($url));
                break;
            case 'php':
                return unserialize($this->_get($url));
                break;

            case 'xml':
                //$xml = unserialize(file_get_contents($url));
                return 'Not Supported as of yet';
                break;

            case 'html':
                return $this->_get($url);
                break;
                    
            case 'rss':
                return 'Not supported as of yet';
                break;
                
            case 'original':
                return file_get_contents($url);
                break;
                    
            default:
                return file_get_contents($url);
                break;
        }
    }

    /**
     * url_from_id
     * Fetches the URL from Site ID
     *
     * @access  private
     * @param   string  $id   Override for ID, so you can specify one rather than fetching it from config
     * @return  string
     */

    private function url_from_id($id = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=SitesManager.getSiteUrlsFromId&idSite='.$this->get_site_id($id).$this->date().'&format=php&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, 'php')[0][0];
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
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  object
     */
    public function actions($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=VisitsSummary.getActions&idSite='.$this->get_site_id().$this->date().'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }

    /**
     * downloads
     * Get file downloads for the specific time period
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function downloads($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=Actions.getDownloads&idSite='.$this->get_site_id().$this->date().'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }
    
    /**
     * keywords
     * Get search keywords for the specific time period
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function keywords($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=Referers.getKeywords&idSite='.$this->get_site_id().$this->date().'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }
    
    /**
     * last_visits
     * Get information about last 10 visits (ip, time, country, pages, etc.)
     *
     * @access  public
     * @param   int     $count      Limit the number of visits returned by $count
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function last_visits($count, $format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=Live.getLastVisitsDetails&idSite='.$this->get_site_id().$this->date().'&filter_limit='.$count.'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }
    
    /**
     * last_visits_parsed
     * Get information about last 10 visits (ip, time, country, pages, etc.) in a formatted array with GeoIP information if enabled
     *
     * @access  public
     * @param   int     $count      Limit the number of visits returned by $count
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function last_visits_parsed($count, $format = null) {
        if(in_array($format, array('xml', 'rss', 'html', 'original'))){
            echo "Sorry, 'xml', 'rss', 'html' and 'original' are not yet supported.";
            return false;
        }
        $url = $this->get_piwik_url().'/index.php?module=API&method=Live.getLastVisitsDetails&idSite='.$this->get_site_id().$this->date().'&filter_limit='.$count.'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        $visits = $this->get_decoded($url, $format);
        
        $data = array();
        foreach($visits as $v)
        {
            // Get the last array element which has information of the last page the visitor accessed
            switch ($this->check_format($format)) {
            case 'json':
                $count = count($v->actionDetails) - 1; 
                $page_link = $v->actionDetails[$count]->url;
                $page_title = $v->actionDetails[$count]->pageTitle;
                
                // Get just the image names (API returns path to icons in piwik install)
                $flag = explode('/', $v->countryFlag);
                $flag_icon = end($flag);
                
                $os = explode('/', $v->operatingSystemIcon);
                $os_icon = end($os);
                
                $browser = explode('/', $v->browserIcon);
                $browser_icon = end($browser);
                
                $data[] = array(
                  'time' => date("M j Y, g:i a", $v->lastActionTimestamp),
                  'title' => $page_title,
                  'link' => $page_link,
                  'ip_address' => $v->visitIp,
                  'provider' => $v->provider,
                  'country' => $v->country,
                  'country_icon' => $flag_icon,
                  'os' => $v->operatingSystem,
                  'os_icon' => $os_icon,
                  'browser' => $v->browserName,
                  'browser_icon' => $browser_icon,
                );
                break;
            case 'php':
                $count = count($v['actionDetails']) - 1; 
                $page_link = $v['actionDetails'][$count]['url'];
                $page_title = $v['actionDetails'][$count]['pageTitle'];
                
                // Get just the image names (API returns path to icons in piwik install)
                $flag = explode('/', $v['countryFlag']);
                $flag_icon = end($flag);
                
                $os = explode('/', $v['operatingSystemIcon']);
                $os_icon = end($os);
                
                $browser = explode('/', $v['browserIcon']);
                $browser_icon = end($browser);
                
                $data[] = array(
                  'time' => date("M j Y, g:i a", $v['lastActionTimestamp']),
                  'title' => $page_title,
                  'link' => $page_link,
                  'ip_address' => $v['visitIp'],
                  'provider' => $v['provider'],
                  'country' => $v['country'],
                  'country_icon' => $flag_icon,
                  'os' => $v['operatingSystem'],
                  'os_icon' => $os_icon,
                  'browser' => $v['browserName'],
                  'browser_icon' => $browser_icon,
                );
                break;

            case 'xml':

                break;

            case 'html':

                break;
                    
            case 'rss':

                break;
                
            case 'original':

                break;
                    
            default:
                $count = count($v->actionDetails) - 1; 
                $page_link = $v->actionDetails[$count]->url;
                $page_title = $v->actionDetails[$count]->pageTitle;
                
                // Get just the image names (API returns path to icons in piwik install)
                $flag = explode('/', $v->countryFlag);
                $flag_icon = end($flag);
                
                $os = explode('/', $v->operatingSystemIcon);
                $os_icon = end($os);
                
                $browser = explode('/', $v->browserIcon);
                $browser_icon = end($browser);
                
                $data[] = array(
                  'time' => date("M j Y, g:i a", $v->lastActionTimestamp),
                  'title' => $page_title,
                  'link' => $page_link,
                  'ip_address' => $v->visitIp,
                  'provider' => $v->provider,
                  'country' => $v->country,
                  'country_icon' => $flag_icon,
                  'os' => $v->operatingSystem,
                  'os_icon' => $os_icon,
                  'browser' => $v->browserName,
                  'browser_icon' => $browser_icon,
                );
                break;
            }
            
        }
        return $data;
    }

    /**
     * actions
     * Get outlinks for the specific time period
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function outlinks($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=Actions.getOutlinks&idSite='.$this->get_site_id().$this->date().'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }
    
    /**
     * page_titles
     * Get page visit information for the specific time period
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function page_titles($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=Actions.getPageTitles&idSite='.$this->get_site_id().$this->date().'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }

    /**
     * search_engines
     * Get search engine referer information for the specific time period
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function search_engines($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=Referers.getSearchEngines&idSite='.$this->get_site_id().$this->date().'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }

    /**
     * unique_visitors
     * Get unique visitors for the specific time period
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function unique_visitors($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=VisitsSummary.getUniqueVisitors&idSite='.$this->get_site_id().$this->date().'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }

    /**
     * visits
     * Get all visits for the specific time period
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function visits($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=VisitsSummary.getVisits&idSite='.$this->get_site_id().$this->date().'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }

    /**
     * websites
     * Get refering websites (traffic sources) for the specific time period
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function websites($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=Referers.getWebsites&idSite='.$this->get_site_id().$this->date().'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }

    /**
     * tag
     * Get javascript tag for use in tracking the website
     *
     * Note: Works best when using PHP as the format
     * 
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  string
     */

    public function tag() {
        $tag = 
'<!-- Piwik -->
<script type="text/javascript">
var _paq = _paq || [];
(function(){ var u=(("https:" == document.location.protocol) ? "'.$this->to_https().'/" : "'.$this->to_http().'/");
_paq.push([\'setSiteId\', '.$this->get_site_id().']);
_paq.push([\'setTrackerUrl\', u+\'piwik.php\']);
_paq.push([\'trackPageView\']);
_paq.push([\'enableLinkTracking\']);
var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0]; g.type=\'text/javascript\'; g.defer=true; g.async=true; g.src=u+\'piwik.js\';
s.parentNode.insertBefore(g,s); })();
</script>
<!-- End Piwik Code -->';
                
        return $tag;
    }

    /**
     * seo_rank
     * Get SEO Rank for the website
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */

    public function seo_rank($id, $format = 'json') { // PHP doesn't seem to work with this, so defaults to JSON
        $url = $this->get_piwik_url().'/index.php?module=API&method=SEO.getRank&url='.$this->url_from_id($id).'&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }  

    /**
     * version
     * Get Version of the Piwik Server
     *
     * @access  public
     * @param   string  $format     Override string for the format of the API Query to be returned as
     * @return  array
     */

    public function version($format = null) {
        $url = $this->get_piwik_url().'/index.php?module=API&method=API.getPiwikVersion&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
        return $this->get_decoded($url, $format);
    }

    /**
     * @param $method
     * @param array $arguments
     * @param bool $id
     * @param bool $period
     * @param null $format
     * @return array
     */
    public function custom($method, $arguments = array(), $id = false, $period = false, $format = null) {
        if($arguments == null){
            $arguments = array();
        }
        if(isset($method)){
            $url = $this->get_piwik_url().'/index.php?module=API&method='.$method;
            foreach($arguments as $key=>$value){
                $url .= '&'.$key.'='.$value;
            }
            if($id){
                $url .= '&idSite='.$this->get_site_id($id);
            }
            if($period === true){
                $url .= $this->date();
            }
            $url .= '&format='.$this->check_format($format).'&token_auth='.$this->get_apikey();
            return $this->get_decoded($url, $format);
        }
    }
  
}