<?php

namespace RobBrazier\Piwik\Query;

use RobBrazier\Piwik\Exception\PiwikException;

class QueryDates {

    const DATE_REGEX = "/^[0-9]{4}\\-[0-9]{1,2}\\-[0-9]{1,2},[0-9]{4}\\-[0-9]{1,2}\\-[0-9]{1,2}$/";

    /**
     * @var QueryDates
     */
    private static $instance;

    /**
     * @var array
     */
    private $map;

    /**
     * QueryDates constructor.
     */
    private function __construct() {
        $this->map = [
            "today" => new QueryDate("day", "today"),
            "yesterday" => new QueryDate("day", "yesterday"),
            "previous7" => new QueryDate("range", "previous7"),
            "previous30" => new QueryDate("range", "previous30"),
            "last7" => new QueryDate("range", "last7"),
            "last30" => new QueryDate("range", "last30"),
            "currentweek" => new QueryDate("week", "today"),
            "currentmonth" => new QueryDate("month", "today"),
            "currentyear" => new QueryDate("year", "today")
        ];
    }


    /**
     * @return QueryDates
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param string $data
     * @return QueryDate
     */
    public function get($data) {
        if (array_has($this->map, $data)) {
            return array_get($this->map, $data);
        } else if (preg_match(self::DATE_REGEX, $data)) {
            return new QueryDate("range", $data);
        }
        throw new PiwikException("Invalid period provided (" . $data . ")");
    }

}