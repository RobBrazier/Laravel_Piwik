<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Base\PiwikBase;

/**
 * Class VisitsSummaryModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#VisitsSummary for arguments
 */
class VisitsSummaryModule extends Module {

    public function __construct(PiwikBase $base) {
        parent::__construct($base);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function get($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getVisits($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getUniqueVisitors($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getUsers($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getActions($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getMaxActions($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getBounceCount($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getVisitsConverted($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getSumVisitsLength($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getSumVisitsLengthPretty($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

}