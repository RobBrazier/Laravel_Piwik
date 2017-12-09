<?php

namespace RobBrazier\Piwik\Exception;

use PHPUnit\Framework\TestCase;

/**
 * Class PiwikExceptionTest.
 */
class PiwikExceptionTest extends TestCase
{
    public function testGetMessage()
    {
        $expectedMessage = 'message';
        $exception = new PiwikException($expectedMessage);
        $this->assertEquals($expectedMessage, $exception->getMessage());
    }
}
