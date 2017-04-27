<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Base\PiwikBase;

/**
 * Class VisitorInterestModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#VisitorInterest for arguments
 */
class VisitorInterestModule extends Module {

    public function __construct(PiwikBase $base) {
        parent::__construct($base);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getNumberOfVisitsPerVisitDuration($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getNumberOfVisitsPerPage($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getNumberOfVisitsByDaysSinceLast($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getNumberOfVisitsByVisitCount($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

}