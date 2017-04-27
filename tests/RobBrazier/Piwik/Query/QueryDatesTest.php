<?php

namespace RobBrazier\Piwik\Query;

/**
 * Class QueryDatesTest
 * @package RobBrazier\Piwik\Query
 * @covers \RobBrazier\Piwik\Query\QueryDates
 */
class QueryDatesTest extends \PHPUnit_Framework_TestCase {

    public function testSingleton() {
        $reflectionClass = new \ReflectionClass('\RobBrazier\Piwik\Query\QueryDates');
        $reflectionProperty = $reflectionClass->getProperty('instance');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue(null);
        $this->assertEquals(QueryDates::getInstance(), QueryDates::getInstance());
    }

    public function testGet() {
        $dates = QueryDates::getInstance();
        $date = $dates->get("yesterday");
        $this->assertEquals("day", $date->getPeriod());
        $this->assertEquals("yesterday", $date->getDate());
    }

    public function testGetDate() {
        $dates = QueryDates::getInstance();
        $expectedDate = "2017-01-01,2017-01-02";
        $date = $dates->get($expectedDate);
        $this->assertEquals("range", $date->getPeriod());
        $this->assertEquals($expectedDate, $date->getDate());
    }

    /**
     * @expectedException \RobBrazier\Piwik\Exception\PiwikException
     */
    public function testGetInvalid() {
        $dates = QueryDates::getInstance();
        $dates->get("invalid");

    }

}
