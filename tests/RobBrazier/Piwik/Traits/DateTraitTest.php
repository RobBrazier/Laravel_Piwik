<?php

namespace RobBrazier\Piwik\Traits;

use PHPUnit\Framework\TestCase;
use RobBrazier\Piwik\Query\QueryDate;

class DateTraitTest extends TestCase
{
    public function testGetDate()
    {
        $dateTrait = new DateTraitStub();
        $date = $dateTrait->getDate('yesterday');
        $this->assertEquals(new QueryDate('day', 'yesterday'), $date);
    }
}

class DateTraitStub
{
    use DateTrait;
}
