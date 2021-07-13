<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Exception\PiwikException;
use RobBrazier\Piwik\Traits\FormatTrait;
use Illuminate\Support\Arr;

/**
 * Class LiveModule.
 *
 * @see https://developer.matomo.org/api-reference/reporting-api#Live for arguments
 */
class LiveModule extends Module
{
    use FormatTrait;

    /**
     * @param int                $lastMinutes number of minutes to filter counters by (e.g. get counters for the last 30 minutes)
     * @param array[string]mixed $arguments   extra arguments to be passed to the api call
     * @param string             $format      override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getCounters($lastMinutes, $arguments = [], $format = null)
    {
        $arguments += ['lastMinutes' => $lastMinutes];
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param int                $count     number of last visits to get (if set to `0`, retrieves all results)
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getLastVisitsDetails($count, $arguments = [], $format = null)
    {
        if ($count > 0) {
            $arguments += ['filter_limit' => $count];
        }
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * last_visits_parsed
     * Get information about last 10 visits (ip, time, country, pages, etc.) in a formatted array
     * with GeoIP information if enabled.
     *
     * @param int    $count  number of last visits to get (if set to `0`, retrieves all results)
     * @param string $format override format (defaults to one specified in config file)
     *
     * @return array
     */
    public function getLastVisitsDetailsParsed($count, $format = null)
    {
        $visits = $this->getLastVisitsDetails($count, [], $format);

        switch ($this->validateFormat($format)) {
            case 'json':
                $visits = json_decode(json_encode($visits), true);
                $data = $this->getParsedLastVisitsDetails($visits);
                break;
            case 'original':
            case 'php':
                $data = $this->getParsedLastVisitsDetails($visits);
                break;
            case 'xml':
                $parsedVisits = [];
                $rows = $visits->count();
                for ($i = 0; $i < $rows; $i++) {
                    $row = json_decode(json_encode($visits->row[$i]), true);
                    array_push($parsedVisits, $row);
                }
                $data = $this->getParsedLastVisitsDetails($parsedVisits);
                break;
            default:
                throw new PiwikException('Format ['.$format.'] is not yet supported.');
        }

        return $data;
    }

    /**
     * @param array $visits
     *
     * @return array[string]string[]
     */
    private function getParsedLastVisitsDetails($visits)
    {
        $result = [];
        foreach ($visits as $visit) {
            $actionDetails = (array) Arr::get($visit, 'actionDetails');
            $actionDetail = (array) Arr::last($actionDetails);
            $pageLink = Arr::get($actionDetail, 'url');
            $pageTitle = Arr::get($actionDetail, 'pageTitle');

            // Get just the image names (API returns path to icons in piwik install)
            $flag = explode('/', Arr::get($visit, 'countryFlag'));
            $flagIcon = end($flag);

            $os = explode('/', Arr::get($visit, 'operatingSystemIcon'));
            $osIcon = end($os);

            $browser = explode('/', Arr::get($visit, 'browserIcon'));
            $browserIcon = end($browser);

            array_push($result, [
                'time'         => date('M j Y, g:i a', Arr::get($visit, 'lastActionTimestamp')),
                'title'        => $pageTitle,
                'link'         => $pageLink,
                'ip_address'   => Arr::get($visit, 'visitIp'),
                'provider'     => Arr::get($visit, 'provider'),
                'country'      => Arr::get($visit, 'country'),
                'country_icon' => $flagIcon,
                'os'           => Arr::get($visit, 'operatingSystem'),
                'os_icon'      => $osIcon,
                'browser'      => Arr::get($visit, 'browserName'),
                'browser_icon' => $browserIcon,
            ]);
        }

        return $result;
    }

    /**
     * @param string             $visitorId visitor id to search for
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getVisitorProfile($visitorId, $arguments = [], $format = null)
    {
        $arguments += ['visitorId' => $visitorId];
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getMostRecentVisitorId($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }
}
