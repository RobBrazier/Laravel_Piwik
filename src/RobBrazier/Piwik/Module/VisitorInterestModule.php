<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Repository\RequestRepository;

/**
 * Class VisitorInterestModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#VisitorInterest for arguments
 */
class VisitorInterestModule extends Module {

    /**
     * VisitorInterestModule constructor.
     * @param RequestRepository $request
     */
    public function __construct($request) {
        parent::__construct($request);
    }

    /**
     * @param array[string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getNumberOfVisitsPerVisitDuration($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getNumberOfVisitsPerPage($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getNumberOfVisitsByDaysSinceLast($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments
     * @param string $format
     * @return mixed
     */
    public function getNumberOfVisitsByVisitCount($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

}