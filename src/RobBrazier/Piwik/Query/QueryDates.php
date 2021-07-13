<?php

namespace RobBrazier\Piwik\Query;

use RobBrazier\Piwik\Exception\PiwikException;

class QueryDates
{
    const DATE_REGEX = '/^[0-9]{4}\\-[0-9]{1,2}\\-[0-9]{1,2},[0-9]{4}\\-[0-9]{1,2}\\-[0-9]{1,2}$/';
    const DAY = 'day';
    const RANGE = 'range';
    const TODAY = 'today';

    /**
     * @var array
     */
    private $map;

    /**
     * @var array
     */
    private $keys;

    /**
     * QueryDates constructor.
     */
    public function __construct()
    {
        $this->map = [
            self::TODAY    => new QueryDate(self::DAY, self::TODAY),
            'yesterday'    => new QueryDate(self::DAY, 'yesterday'),
            'previous7'    => new QueryDate(self::RANGE, 'previous7'),
            'previous30'   => new QueryDate(self::RANGE, 'previous30'),
            'last7'        => new QueryDate(self::RANGE, 'last7'),
            'last30'       => new QueryDate(self::RANGE, 'last30'),
            'currentweek'  => new QueryDate('week', self::TODAY),
            'currentmonth' => new QueryDate('month', self::TODAY),
            'currentyear'  => new QueryDate('year', self::TODAY),
        ];
        $this->keys = array_keys($this->map);
    }

    /**
     * @param string $data
     *
     * @return QueryDate
     */
    public function get(string $data): QueryDate
    {
        if (in_array($data, $this->keys)) {
            return $this->map[$data];
        } elseif (preg_match(self::DATE_REGEX, $data)) {
            return new QueryDate('range', $data);
        }

        throw new PiwikException('Invalid period provided ('.$data.')');
    }
}
