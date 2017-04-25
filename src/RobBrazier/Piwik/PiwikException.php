<?php
/**
 * Created by IntelliJ IDEA.
 * User: Rob
 * Date: 23/04/2017
 * Time: 22:46
 */

namespace RobBrazier\Piwik;


class PiwikException extends \RuntimeException {

    /**
     * PiwikException constructor.
     * @param string $message
     */
    public function __construct($message) {
        parent::__construct($message);
    }

}