<?php

namespace RobBrazier\Piwik\Query;

/**
 * Class QueryDateTest
 * @package RobBrazier\Piwik\Query
 * @covers \RobBrazier\Piwik\Query\QueryDate
 */
class QueryDateTest extends \PHPUnit_Framework_TestCase {

    public function testGetPeriod() {
        $date = new QueryDate("day", "today");
        $this->assertEquals("day", $date->getPeriod());
    }

    public function testGetDate() {
        $date = new QueryDate("day", "today");
        $this->assertEquals("today", $date->getDate());
    }

}
