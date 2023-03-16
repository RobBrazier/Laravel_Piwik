<?php

namespace RobBrazier\Piwik\Module;

class UserCountryModule extends Module
{
    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getCountry($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getContinent($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getRegion($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getCity($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getCountryCodeMapping($format = null)
    {
        $options = $this->getOptions($format)->setArguments([]);

        return $this->request->send($options);
    }

    /**
     * @param string             $ip        The IP to search for a location from
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getLocationFromIP($ip, $arguments = [], $format = null)
    {
        $arguments += ['ip' => $ip];
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getNumberOfDistinctCountries($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }
}
