<?php

namespace RobBrazier\Piwik\Facades;

use Illuminate\Support\Facades\Facade;

class Piwik extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'piwik'; }

}
