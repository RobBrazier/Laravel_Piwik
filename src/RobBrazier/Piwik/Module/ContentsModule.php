<?php

namespace RobBrazier\Piwik\Module;

/**
 * Class ContentsModule.
 *
 * @see https://developer.matomo.org/api-reference/reporting-api#Contents for arguments
 */
class ContentsModule extends Module
{
    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string             $format    override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getContentNames($arguments = [], $format = null)
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
    public function getContentPieces($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);

        return $this->request->send($options);
    }
}
