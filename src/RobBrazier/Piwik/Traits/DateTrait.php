<?php

namespace RobBrazier\Piwik\Traits;

use RobBrazier\Piwik\Query\QueryDate;
use RobBrazier\Piwik\Query\QueryDates;

trait DateTrait
{
    private $instance;
    /**
     * Get QueryDate object from period name.
     *
     * e.g. "yesterday" => QueryDate(period = "day", date = "yesterday")
     *
     * @param string $period
     *
     * @return QueryDate
     */
    public function getDate(string $period): QueryDate
    {
        if ($this->instance === null) {
            $this->instance = new QueryDates();
        }
        return $this->instance->get($period);
    }
}
