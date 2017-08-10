<?php

namespace RobBrazier\Piwik\Module;

/**
 * Class ProviderModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#Provider for arguments
 */
class ProviderModule extends Module {

    /**
     * @param array[string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getProvider($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

}
