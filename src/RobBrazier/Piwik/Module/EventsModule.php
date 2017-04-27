<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Base\PiwikBase;

/**
 * Class EventsModule
 * @package RobBrazier\Piwik\Module
 * @see https://developer.piwik.org/api-reference/reporting-api#Events for arguments
 */
class EventsModule extends Module {

    public function __construct(PiwikBase $base) {
        parent::__construct($base);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getCategory($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getAction($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getName($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getActionFromCategoryId($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getNameFromCategoryId($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getCategoryFromActionId($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getNameFromActionId($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getActionFromNameId($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

    /**
     * @param array $arguments
     * @param string|null $format
     * @return mixed
     */
    public function getCategoryFromNameId($arguments = [], $format = null) {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->base->getCustom($options);
    }

}