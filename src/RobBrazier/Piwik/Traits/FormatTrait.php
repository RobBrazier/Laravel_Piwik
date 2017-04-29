<?php

namespace RobBrazier\Piwik\Traits;


use RobBrazier\Piwik\Exception\PiwikException;
use RobBrazier\Piwik\Repository\RequestRepository;

trait FormatTrait {

    /**
     * Check format against allowed values
     *
     * @param string $format
     * @throws PiwikException
     * @return string
     */
    public function validateFormat($format) {
        if (!in_array($format, RequestRepository::ALLOWED_FORMATS)) {
            throw new PiwikException("Invalid format [" . $format . "]");
        }
        return $format;
    }

}