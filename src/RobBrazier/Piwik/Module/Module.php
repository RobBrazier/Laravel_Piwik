<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Base\PiwikBase;
use RobBrazier\Piwik\Request\RequestOptions;

abstract class Module {

    /**
     * @var PiwikBase
     */
    protected $base;

    /**
     * Module constructor.
     * @param PiwikBase $base
     */
    public function __construct(PiwikBase $base) {
        $this->base = $base;
    }


    /**
     * @return RequestOptions
     */
    protected function getOptions($format) {
        $requestOptions = new RequestOptions();
        $childModule = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];
        $moduleName = $this->getModuleName($childModule['class']);
        $actionName = $childModule['function'];
        $requestOptions->setMethod("$moduleName.$actionName");
        $requestOptions->setFormat($format);
        return $requestOptions;
    }

    private function getModuleName($className) {
        $matches = [];
        $moduleClassName = last(explode("\\", $className));
        $moduleName = str_replace("Module", "", $moduleClassName);
        return $moduleName;
    }

}