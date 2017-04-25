<?php

namespace RobBrazier\Piwik\Query;


class QueryDate {

    /**
     * @var string
     */
    private $period;

    /**
     * @var string
     */
    private $date;

    /**
     * Date constructor.
     * @param string $period
     * @param string $date
     */
    public function __construct($period, $date)
    {
        $this->period = $period;
        $this->date = $date;
    }


    /**
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

}