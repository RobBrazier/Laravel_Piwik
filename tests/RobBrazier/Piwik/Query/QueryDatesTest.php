<?php

namespace RobBrazier\Piwik\Query;

use PHPUnit\Framework\TestCase;
use RobBrazier\Piwik\Exception\PiwikException;

/**
 * Class QueryDatesTest.
 */
class QueryDatesTest extends TestCase
{

    public function testGet()
    {
        $dates = new QueryDates();
        $date = $dates->get('yesterday');
        $this->assertEquals('day', $date->getPeriod());
        $this->assertEquals('yesterday', $date->getDate());
    }

    public function testGetDate()
    {
        $dates = new QueryDates();
        $expectedDate = '2017-01-01,2017-01-02';
        $date = $dates->get($expectedDate);
        $this->assertEquals('range', $date->getPeriod());
        $this->assertEquals($expectedDate, $date->getDate());
    }

    public function testGetInvalid()
    {
        $this->expectException(PiwikException::class);
        $dates = new QueryDates();
        $dates->get('invalid');
    }
}
