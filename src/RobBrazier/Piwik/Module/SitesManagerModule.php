<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Base\PiwikBase;

/**
 * Class SitesManagerModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#SitesManager for arguments
 */
class SitesManagerModule extends Module {

    public function __construct(PiwikBase $base) {
        parent::__construct($base);
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
        return $this->base->getCustom($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSiteGroups($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->base->getCustom($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesFromId($format = null) {
        $options = $this->getOptions($format)
            ->usePeriod(false);
        return $this->base->getCustom($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getAllSites($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->base->getCustom($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getAllSitesId($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->base->getCustom($options);
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
        return $this->base->getCustom($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesWithViewAccess($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->base->getCustom($options);
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
        return $this->base->getCustom($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesIdWithAdminAccess($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->base->getCustom($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesIdWithViewAccess($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->base->getCustom($options);
    }


    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSitesIdWithAtLeastViewAccess($format = null) {
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false);
        return $this->base->getCustom($options);
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
        return $this->base->getCustom($options);
    }



}