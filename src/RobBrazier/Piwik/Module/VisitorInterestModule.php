<?php

namespace RobBrazier\Piwik\Module;

/**
 * Class VisitorInterestModule.
 *
 * @see https://developer.piwik.org/api-reference/reporting-api#VisitorInterest for arguments
 */
class VisitorInterestModule extends Module
{
    /**
     * @param array[string]mixed $arguments
     * @param string             $format
     *
     * @return mixed
     */
    public function getNumberOfVisitsPerVisitDuration($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments
     * @param string             $format
     *
     * @return mixed
     */
    public function getNumberOfVisitsPerPage($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments
     * @param string             $format
     *
     * @return mixed
     */
    public function getNumberOfVisitsByDaysSinceLast($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments
     * @param string             $format
     *
     * @return mixed
     */
    public function getNumberOfVisitsByVisitCount($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }
}
