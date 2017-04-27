<?php

namespace RobBrazier\Piwik\Repository;

interface ConfigRepository {

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key);

}