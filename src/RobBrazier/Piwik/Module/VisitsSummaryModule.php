<?php

namespace RobBrazier\Piwik\Module;

/**
 * Class VisitsSummaryModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#VisitsSummary for arguments
 */
class VisitsSummaryModule extends Module
{

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function get($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getVisits($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getUniqueVisitors($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getUsers($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getActions($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getMaxActions($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getBounceCount($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getVisitsConverted($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getSumVisitsLength($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getSumVisitsLengthPretty($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

}
