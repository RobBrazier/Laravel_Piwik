<?php

namespace RobBrazier\Piwik\Repository;

use RobBrazier\Piwik\Request\RequestOptions;

interface RequestRepository {

    /**
     * @param RequestOptions $requestOptions
     * @return mixed
     */
    public function send(RequestOptions $requestOptions);

}