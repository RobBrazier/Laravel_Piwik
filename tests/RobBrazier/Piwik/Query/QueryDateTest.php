<?php

namespace RobBrazier\Piwik\Query;

use PHPUnit\Framework\TestCase;

/**
 * Class QueryDateTest
 * @package RobBrazier\Piwik\Query
 */
class QueryDateTest extends TestCase
{

    public function testGetPeriod()
    {
        $date = new QueryDate("day", "today");
        $this->assertEquals("day", $date->getPeriod());
    }

    public function testGetDate()
    {
        $date = new QueryDate("day", "today");
        $this->assertEquals("today", $date->getDate());
    }

}
