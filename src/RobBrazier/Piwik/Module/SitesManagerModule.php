<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Repository\RequestRepository;

/**
 * Class SitesManagerModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#SitesManager for arguments
 */
class SitesManagerModule extends Module {

    /**
     * SitesManagerModule constructor.
     * @param RequestRepository $request
     */
    public function __construct(RequestRepository $request) {
        parent::__construct($request);
    }

    /**
     * @param string $group
     * @param string|null $format
     * @return mixed
     */
    public function getSitesFromGroup($group, $format = null) {
        $arguments = [
            "group" => $group
        ];
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSiteGroups($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesFromId($format = null) {
        $options = $this->getOptions($format)
            ->usePeriod(false);
        return $this->request->send($options);
    }

    public function getSiteUrlsFromId($siteId = null, $format = null) {
        $options = $this->getOptions($format)
            ->usePeriod(false);
        if (!is_null($siteId)) {
            $options->setSiteId($siteId);
        }
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getAllSites($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getAllSitesId($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->request->send($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getSitesWithAdminAccess($arguments = [], $format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesWithViewAccess($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->request->send($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getSitesWithAtLeastViewAccess($arguments = [], $format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesIdWithAdminAccess($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesIdWithViewAccess($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->request->send($options);
    }


    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesIdWithAtLeastViewAccess($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->request->send($options);
    }

    /**
     * @param string $url
     * @param string|null $format
     * @return mixed
     */
    public function getSitesIdFromSiteUrl($url, $format = null) {
        $arguments = [
            "url" => $url
        ];
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);
        return $this->request->send($options);
    }



}