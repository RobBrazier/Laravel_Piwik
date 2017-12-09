<?php

namespace RobBrazier\Piwik\Repository;

interface ConfigRepository
{
    /**
     * Retrieve a configuration item.
     *
     * @param string     $key     configuration key
     * @param mixed|null $default default value
     *
     * @return mixed
     */
    public function get($key, $default = null);
}
