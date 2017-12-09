<?php

namespace RobBrazier\Piwik\Traits;

use RobBrazier\Piwik\Query\QueryDate;
use RobBrazier\Piwik\Query\QueryDates;

trait DateTrait
{
    /**
     * Get QueryDate object from period name.
     *
     * e.g. "yesterday" => QueryDate(period = "day", date = "yesterday")
     *
     * @param string $period
     *
     * @return QueryDate
     */
    public function getDate($period)
    {
        return QueryDates::getInstance()->get($period);
    }
}
