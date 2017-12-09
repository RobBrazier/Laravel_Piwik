<?php

namespace RobBrazier\Piwik\Module;

/**
 * Class SitesManagerModule.
 *
 * @see https://developer.piwik.org/api-reference/reporting-api#SitesManager for arguments
 */
class SitesManagerModule extends Module
{
    /**
     * @param string $group
     * @param string $format
     *
     * @return mixed
     */
    public function getSitesFromGroup($group, $format = null)
    {
        $arguments = [
            'group' => $group,
        ];
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getSiteGroups($format = null)
    {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getSitesFromId($format = null)
    {
        $options = $this->getOptions($format)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
     * @param int    $siteId
     * @param string $format
     *
     * @return mixed
     */
    public function getSiteUrlsFromId($siteId = null, $format = null)
    {
        $options = $this->getOptions($format)
            ->usePeriod(false);
        if (!is_null($siteId)) {
            $options->setSiteId($siteId);
        }

        return $this->request->send($options);
    }

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getAllSites($format = null)
    {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getAllSitesId($format = null)
    {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
<<<<<<< Updated upstream
     * @param array[string]mixed $arguments
     * @param string             $format
     *
=======
     * @param array [string]mixed $arguments
     * @param string $format
>>>>>>> Stashed changes
     * @return mixed
     */
    public function getSitesWithAdminAccess($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getSitesWithViewAccess($format = null)
    {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments
     * @param string             $format
     *
     * @return mixed
     */
    public function getSitesWithAtLeastViewAccess($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getSitesIdWithAdminAccess($format = null)
    {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getSitesIdWithViewAccess($format = null)
    {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
     * @param string $format
     *
     * @return mixed
     */
    public function getSitesIdWithAtLeastViewAccess($format = null)
    {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
     * @param string $url
     * @param string $format
     *
     * @return mixed
     */
    public function getSitesIdFromSiteUrl($url, $format = null)
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
}
