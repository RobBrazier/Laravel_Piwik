<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Exception\PiwikException;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Traits\FormatTrait;

/**
 * Class LiveModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#Live for arguments
 */
class LiveModule extends Module {

    use FormatTrait;

    /**
     * LiveModule constructor.
     * @param RequestRepository $request
     */
    public function __construct(RequestRepository $request) {
        parent::__construct($request);
    }

    /**
     * @param int $lastMinutes
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getCounters($lastMinutes, $arguments = [], $format = null) {
        $arguments = array_add($arguments, "lastMinutes", $lastMinutes);
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param int $count
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getLastVisitsDetails($count, $arguments = [], $format = null) {
        $arguments = array_add($arguments, "filter_limit", $count);
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * last_visits_parsed
     * Get information about last 10 visits (ip, time, country, pages, etc.) in a formatted array
     * with GeoIP information if enabled
     *
     * @access  public
     * @deprecated
     * @param   int $count      Limit the number of visits returned by $count
     * @param   string $format  Override string for the format of the API Query to be returned as
     * @return  array
     */
    public function getLastVisitsDetailsParsed($count, $format = null) {
        $visits = $this->getLastVisitsDetails($count, [], $format);

        $data = [];
        foreach ($visits as $v) {
            // Get the last array element which has information of the last page the visitor accessed
            switch ($this->validateFormat($format)) {
                case 'json':
                    // no break as the logic is the same as in the php case, but with an object to array conversion
                    $v = (array) $v;
                case 'php':
                    $actionDetails = (array) array_get($v, 'actionDetails');
                    $actionDetail = (array) array_last($actionDetails);
                    $pageLink = array_get($actionDetail, 'url');
                    $pageTitle = array_get($actionDetail, 'pageTitle');

                    // Get just the image names (API returns path to icons in piwik install)
                    $flag = explode('/', array_get($v, 'countryFlag'));
                    $flagIcon = end($flag);

                    $os = explode('/', array_get($v, 'operatingSystemIcon'));
                    $osIcon = end($os);

                    $browser = explode('/', array_get($v, 'browserIcon'));
                    $browserIcon = end($browser);

                    $data[] = [
                        'time' => date("M j Y, g:i a", array_get($v, 'lastActionTimestamp')),
                        'title' => $pageTitle,
                        'link' => $pageLink,
                        'ip_address' => array_get($v, 'visitIp'),
                        'provider' => array_get($v, 'provider'),
                        'country' => array_get($v, 'country'),
                        'country_icon' => $flagIcon,
                        'os' => array_get($v, 'operatingSystem'),
                        'os_icon' => $osIcon,
                        'browser' => array_get($v, 'browserName'),
                        'browser_icon' => $browserIcon,
                    ];
                    break;
                default:
                    throw new PiwikException("Format [" . $format . "] is not yet supported.");
            }

        }
        return $data;
    }

    /**
     * @param string $visitorId
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getVisitorProfile($visitorId, $arguments = [], $format = null) {
        $arguments = array_add($arguments, "visitorId", $visitorId);
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getMostRecentVisitorId($arguments = [], $format = null) {
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->setArguments($arguments);
        return $this->request->send($options);
    }

}