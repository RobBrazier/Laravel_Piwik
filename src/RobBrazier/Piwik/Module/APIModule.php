<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Repository\RequestRepository;

/**
 * Class APIModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#API for arguments
 */
class APIModule extends Module {

    /**
     * APIModule constructor.
     * @param RequestRepository $request
     */
    public function __construct(RequestRepository $request) {
        parent::__construct($request);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getPiwikVersion($format = null) {
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getIpFromHeader($format = null) {
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getSettings($format = null) {
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false);
        return $this->request->send($options);
    }

    /**
     * @param array $siteIds
     * @param string|null $format
     * @return mixed
     */
    public function getSegmentsMetadata($siteIds, $format = null) {
        $idSites = implode(",", $siteIds);
        $arguments = [
            "idSites" => $idSites
        ];
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getMetadata($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array $siteIds
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getReportMetadata($siteIds = [], $arguments = [], $format = null) {
        $idSites = implode(",", $siteIds);
        $arguments = array_add($arguments, "idSites", $idSites);
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string $apiModule
     * @param string $apiAction
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getProcessedReport($apiModule, $apiAction, $arguments = [], $format = null) {
        $arguments = array_add($arguments, "apiModule", $apiModule);
        $arguments = array_add($arguments, "apiAction", $apiAction);
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getReportPagesMetadata($format = null) {
        $options = $this->getOptions($format)
            ->usePeriod(false);
        return $this->request->send($options);
    }

    /**
     * @param string|null $format
     * @return mixed
     */
    public function getWidgetMetadata($format = null) {
        $options = $this->getOptions($format)
            ->usePeriod(false);
        return $this->request->send($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function get($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string $apiModule
     * @param string $apiAction
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getRowEvolution($apiModule, $apiAction, $arguments = [], $format = null) {
        $arguments = array_add($arguments, "apiModule", $apiModule);
        $arguments = array_add($arguments, "apiAction", $apiAction);
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

}