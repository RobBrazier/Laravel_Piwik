<?php

namespace RobBrazier\Piwik\Traits;

use RobBrazier\Piwik\Exception\PiwikException;

trait FormatTrait
{
    private $allowedFormats = ['json', 'php', 'xml', 'html', 'rss'];

    /**
     * Check format against allowed values.
     *
     * @param string $format format to validate
     *
     * @throws PiwikException exception thrown if invalid format is passed
     *
     * @return string the format if it has passed validation
     */
    public function validateFormat($format)
    {
        if (!in_array($format, $this->allowedFormats)) {
            throw new PiwikException('Invalid format ['.$format.']');
        }

        return $format;
    }
}
