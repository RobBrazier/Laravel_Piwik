<?php

namespace RobBrazier\Piwik\Exception;


class PiwikException extends \RuntimeException {

    /**
     * PiwikException constructor.
     * @param string $message
     */
    public function __construct($message) {
        parent::__construct($message);
    }

}