<?php

namespace RobBrazier\Piwik;

/**
 * Class PiwikExceptionTest
 * @package RobBrazier\Piwik
 */
class PiwikExceptionTest extends \PHPUnit_Framework_TestCase{

    public function testGetMessage() {
        $expectedMessage = "message";
        $exception = new PiwikException($expectedMessage);
        $this->assertEquals($expectedMessage, $exception->getMessage());
    }

}