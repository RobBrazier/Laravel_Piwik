<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Exception\PiwikException;
use RobBrazier\Piwik\Traits\ArrayAccessTrait;
use RobBrazier\Piwik\Traits\FormatTrait;

/**
 * Class LiveModule.
 *
 * @see https://developer.matomo.org/api-reference/reporting-api#Live for arguments
 */
class LiveModule extends Module
{
    use FormatTrait;
    use ArrayAccessTrait;

    /**
     * @param int $lastMinutes number of minutes to filter counters by (e.g. get counters for the last 30 minutes)
     * @param array[string]mixed $arguments   extra arguments to be passed to the api call
     * @param string|null $format      override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getCounters(int $lastMinutes, $arguments = [], string $format = null)
    {
        $arguments += ['lastMinutes' => $lastMinutes];
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param int $count     number of last visits to get (if set to `0`, retrieves all results)
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string|null $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getLastVisitsDetails(int $count, $arguments = [], string $format = null)
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
     * @param int $count  number of last visits to get (if set to `0`, retrieves all results)
     * @param string|null $format override format (defaults to one specified in config file)
     *
     * @return array
     */
    public function getLastVisitsDetailsParsed(int $count, string $format = null): array
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
    private function getParsedLastVisitsDetails(array $visits): array
    {
        $result = [];
        foreach ($visits as $visit) {
            $actionDetails = (array) $this->safeGetArrayEntry($visit, 'actionDetails');
            $actionDetail = (array) end($actionDetails);
            $pageLink = $this->safeGetArrayEntry($actionDetail, 'url');
            $pageTitle = $this->safeGetArrayEntry($actionDetail, 'pageTitle');

            // Get just the image names (API returns path to icons in piwik install)
            $flag = explode('/', $this->safeGetArrayEntry($visit, 'countryFlag'));
            $flagIcon = end($flag);

            $os = explode('/', $this->safeGetArrayEntry($visit, 'operatingSystemIcon'));
            $osIcon = end($os);

            $browser = explode('/', $this->safeGetArrayEntry($visit, 'browserIcon'));
            $browserIcon = end($browser);

            array_push($result, [
                'time'         => date('M j Y, g:i a', $this->safeGetArrayEntry($visit, 'lastActionTimestamp')),
                'title'        => $pageTitle,
                'link'         => $pageLink,
                'ip_address'   => $this->safeGetArrayEntry($visit, 'visitIp'),
                'provider'     => $this->safeGetArrayEntry($visit, 'provider'),
                'country'      => $this->safeGetArrayEntry($visit, 'country'),
                'country_icon' => $flagIcon,
                'os'           => $this->safeGetArrayEntry($visit, 'operatingSystem'),
                'os_icon'      => $osIcon,
                'browser'      => $this->safeGetArrayEntry($visit, 'browserName'),
                'browser_icon' => $browserIcon,
            ]);
        }

        return $result;
    }

    /**
     * @param string $visitorId visitor id to search for
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string|null $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getVisitorProfile(string $visitorId, $arguments = [], string $format = null)
    {
        $arguments += ['visitorId' => $visitorId];
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string|null $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getMostRecentVisitorId($arguments = [], string $format = null)
    {
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }
}
