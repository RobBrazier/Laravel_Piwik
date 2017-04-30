<?php

namespace RobBrazier\Piwik\Repository;

use RobBrazier\Piwik\Request\RequestOptions;

interface RequestRepository {

    /**
     * Allowed Response formats
     * @var array
     */
    const ALLOWED_FORMATS = ["json", "php", "xml", "html", "rss"];

    /**
     * @param RequestOptions $requestOptions
     * @return mixed
     */
    public function send(RequestOptions $requestOptions);

}