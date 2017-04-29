<?php

namespace RobBrazier\Piwik\Repository\Config;

use RobBrazier\Piwik\Repository\ConfigRepository;

class FileConfigRepository implements ConfigRepository {

    /**
     * @inheritdoc
     */
    public function get($key, $default = null) {
        return config('piwik.' . $key, $default);
    }
}