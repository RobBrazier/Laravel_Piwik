<?php

namespace RobBrazier\Piwik\Query;


class UrlQueryBuilderTest extends \PHPUnit_Framework_TestCase {

    const MODULE = "API";
    const METHOD = "Method.name";
    const SITE_ID = "1";
    const FORMAT = "json";
    const TOKEN_AUTH = "anonymous";

    public function testBuild() {
        $date = QueryDates::getInstance()->get("yesterday");
        $builder = new UrlQueryBuilder();
        $builder->setModule(self::MODULE);
        $builder->setMethod(self::METHOD);
        $builder->setDate($date);
        $builder->setSiteId(self::SITE_ID);
        $builder->setFormat(self::FORMAT);
        $builder->setTokenAuth(self::TOKEN_AUTH);
        $arguments = array(
            "foo" => "bar"
        );
        $builder->addAll($arguments);
        $query = $builder->build();
        $expectedData = array(UrlQueryBuilder::MODULE, self::MODULE,
            UrlQueryBuilder::METHOD, self::METHOD,
            UrlQueryBuilder::PERIOD, $date->getPeriod(),
            UrlQueryBuilder::DATE, $date->getDate(),
            UrlQueryBuilder::SITE_ID, self::SITE_ID,
            UrlQueryBuilder::FORMAT, self::FORMAT,
            UrlQueryBuilder::TOKEN_AUTH, self::TOKEN_AUTH,
            "foo", "bar");
        $argumentSize = sizeof($expectedData);
        $separator = "";
        $format = "?";
        for ($i = 0; $i < $argumentSize/2; $i++) {
            $format .= $separator . "%s=%s";
            $separator = "&";
        }
        $expectedQuery = vsprintf($format, $expectedData);
        $this->assertEquals($expectedQuery, $query);

    }

}
