<?php

namespace RobBrazier\Piwik\Traits;

trait ArrayAccessTrait
{

    /**
     * @param array $haystack
     *
     * @param string needle
     * @return mixed
     */
    private function safeGetArrayEntry(array $haystack, $needle, $default = null)
    {
        if (in_array($needle, array_keys($haystack))) {
            return $haystack[$needle];
        }
        return $default;
    }

    /**
     * @param array $array
     * @param string $prepend
     * @return array
     */
    private function flattenArrayByDot(array $array, string $prepend = ''): array
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value) && ! empty($value)) {
                $results = array_merge($results, $this->flattenArrayByDot($value, $prepend.$key.'.'));
            } else {
                $results[$prepend.$key] = $value;
            }
        }

        return $results;
    }

}
