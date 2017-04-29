<?php

namespace RobBrazier\Piwik\Repository;

interface ConfigRepository {

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null);

}