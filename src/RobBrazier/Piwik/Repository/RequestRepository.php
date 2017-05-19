<?php

namespace RobBrazier\Piwik\Repository;

use RobBrazier\Piwik\Request\RequestOptions;

interface RequestRepository {

    /**
     * Send a request to the Piwik API
     *
     * @param RequestOptions $requestOptions
     * @return mixed
     */
    public function send($requestOptions);

}