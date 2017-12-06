<?php

namespace RobBrazier\Piwik\Module;

use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

abstract class Module
{

    /**
     * @var RequestRepository
     */
    protected $request;

    /**
     * Module constructor.
     * @param RequestRepository $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }


    /**
     * @param string $format response format
     * @return RequestOptions
     */
    protected function getOptions($format)
    {
        $requestOptions = new RequestOptions();
        $childModule = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];
        $moduleName = $this->getModuleName($childModule['class']);
        $actionName = $childModule['function'];
        $requestOptions->setMethod("$moduleName.$actionName");
        $requestOptions->setFormat($format);
        return $requestOptions;
    }

    /**
     * @param string $className
     * @return string
     */
    private function getModuleName($className)
    {
        $moduleClassName = last(explode("\\", $className));
        return str_replace("Module", "", $moduleClassName);
    }
}
