<?php

namespace RobBrazier\Piwik\Repository\Config;

use RobBrazier\Piwik\Repository\ConfigRepository;

class FileConfigRepository implements ConfigRepository {

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key) {
        return config('piwik.' . $key);
    }
}