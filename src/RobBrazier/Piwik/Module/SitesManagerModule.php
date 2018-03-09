<?php

namespace RobBrazier\Piwik\Module;

/**
 * Class SitesManagerModule.
 *
 * @see https://developer.matomo.org/api-reference/reporting-api#SitesManager for arguments
 */
class SitesManagerModule extends Module
{
    /**
     * @param string $group  group to search for
     * @param string $format override format (defaults to one specified in config file)
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
     * @param string $format override format (defaults to one specified in config file)
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
     * @param string $format override format (defaults to one specified in config file)
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
     * @param int    $siteId Override for ID, so you can specify one rather than fetching it from config
     * @param string $format override format (defaults to one specified in config file)
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
     * @param string $format override format (defaults to one specified in config file)
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
     * @param string $format override format (defaults to one specified in config file)
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
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
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
     * @param string $format override format (defaults to one specified in config file)
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
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
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
     * @param string $format override format (defaults to one specified in config file)
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
     * @param string $format override format (defaults to one specified in config file)
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
     * @param string $format override format (defaults to one specified in config file)
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
     * @param string $url    site url
     * @param string $format override format (defaults to one specified in config file)
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

    /**
     * @param string             $siteName  name of the site to be created
     * @param array[string]      $urls      list of urls associated with the new site
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function addSite($siteName, $urls = [], $arguments = [], $format = null)
    {
        $arguments = array_add($arguments, 'siteName', $siteName);
        $arguments = array_add($arguments, 'urls', $urls);

        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }
}
