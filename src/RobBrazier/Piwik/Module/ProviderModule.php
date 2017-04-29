<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Repository\RequestRepository;

/**
 * Class ProviderModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#Provider for arguments
 */
class ProviderModule extends Module {

    /**
     * ProviderModule constructor.
     * @param RequestRepository $request
     */
    public function __construct(RequestRepository $request) {
        parent::__construct($request);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getProvider($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

}