<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Base\PiwikBase;

/**
 * Class ProviderModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#Provider for arguments
 */
class ProviderModule extends Module {

    public function __construct(PiwikBase $base) {
        parent::__construct($base);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getProvider($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

}