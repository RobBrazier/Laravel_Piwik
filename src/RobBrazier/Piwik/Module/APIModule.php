<?php

namespace RobBrazier\Piwik\Module;

/**
 * Class APIModule.
 *
 * @see https://developer.matomo.org/api-reference/reporting-api#API for arguments
 */
class APIModule extends Module
{
    /**
     * @param string $format override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getPiwikVersion($format = null)
    {
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false);

        return $this->request->send($options);
    }

    /**
     * @param string $format override format (defaults to one specified in config file)* @param string $format
     *
     * @return mixed
     */
    public function getIpFromHeader($format = null)
    {
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false);

        return $this->request->send($options);
    }

    /**
     * @param string $format override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getSettings($format = null)
    {
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false);

        return $this->request->send($options);
    }

    /**
     * @param string[] $siteIds list of site ids to get segment metadata for
     * @param string   $format  override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getSegmentsMetadata($siteIds, $format = null)
    {
        $idSites = implode(',', $siteIds);
        $arguments = [
            'idSites' => $idSites,
        ];
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getMetadata($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param string[]           $siteIds   list of site ids to get report metadata for
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getReportMetadata($siteIds, $arguments = [], $format = null)
    {
        $idSites = implode(',', $siteIds);
        $arguments = array_add($arguments, 'idSites', $idSites);
        $options = $this->getOptions($format)
            ->usePeriod(false)
            ->useSiteId(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param string             $apiModule api module to get report for
     * @param string             $apiAction api action/method to get report for
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getProcessedReport($apiModule, $apiAction, $arguments = [], $format = null)
    {
        $arguments = array_add($arguments, 'apiModule', $apiModule);
        $arguments = array_add($arguments, 'apiAction', $apiAction);
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param string $format override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getReportPagesMetadata($format = null)
    {
        $options = $this->getOptions($format)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
     * @param string $format override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getWidgetMetadata($format = null)
    {
        $options = $this->getOptions($format)
            ->usePeriod(false);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function get($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param string             $apiModule api module to get report for
     * @param string             $apiAction api action/method to get report for
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getRowEvolution($apiModule, $apiAction, $arguments = [], $format = null)
    {
        $arguments = array_add($arguments, 'apiModule', $apiModule);
        $arguments = array_add($arguments, 'apiAction', $apiAction);
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }
}
