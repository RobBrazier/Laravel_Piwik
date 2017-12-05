<?php

namespace RobBrazier\Piwik\Module;

use Illuminate\Support\Arr;

/**
 * Class ActionsModule
 * @package RobBrazier\Piwik\Module
 */
class ActionsModule extends Module
{

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function get($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getPageUrls($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getPageUrlsFollowingSiteSearch($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getPageTitlesFollowingSiteSearch($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getEntryPageUrls($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getExitPageUrls($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string $pageUrl page url to get actions for
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getPageUrl($pageUrl, $arguments = [], $format = null)
    {
        $arguments = Arr::add($arguments, "pageUrl", $pageUrl);
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getPageTitles($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getEntryPageTitles($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getExitPageTitles($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string $pageName page name to get actions for
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getPageTitle($pageName, $arguments = [], $format = null)
    {
        $arguments = Arr::add($arguments, "pageName", $pageName);
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getDownloads($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string $downloadUrl download url to get actions for
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getDownload($downloadUrl, $arguments = [], $format = null)
    {
        $arguments = Arr::add($arguments, "downloadUrl", $downloadUrl);
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getOutlinks($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param string $outlinkUrl outlink url to get actions for
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getOutlink($outlinkUrl, $arguments = [], $format = null)
    {
        $arguments = Arr::add($arguments, "outlinkUrl", $outlinkUrl);
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getSiteSearchKeywords($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getSiteSearchNoResultKeywords($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

    /**
     * @param array [string]mixed $arguments extra arguments to be passed to the api call
     * @param string $format override format (defaults to one specified in config file)
     * @return mixed
     */
    public function getSiteSearchCategories($arguments = [], $format = null)
    {
        $options = $this->getOptions($format)->setArguments($arguments);
        return $this->request->send($options);
    }

}
