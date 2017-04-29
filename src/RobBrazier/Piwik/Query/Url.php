<?php

namespace RobBrazier\Piwik\Query;


use RobBrazier\Piwik\Exception\PiwikException;

class Url {

    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $path;


    /**
     * Url constructor.
     * @param string $url
     */
    public function __construct($url) {
        $parsedUrl = parse_url($url);
        if (is_bool($parsedUrl)) {
            throw new PiwikException("Cannot parse URL [" . $url . "]");
        }
        $this->scheme = $this->getPart($parsedUrl, 'scheme');
        $this->host = $this->getPart($parsedUrl, 'host');
        $this->port = $this->getPart($parsedUrl, 'port', 0);
        $this->path = $this->getPart($parsedUrl, 'path');
    }

    /**
     * @param array $parts
     * @param string $part
     * @param mixed $default
     * @return mixed
     */
    private function getPart($parts, $part, $default = "") {
        return array_get($parts, $part, $default);
    }

    /**
     * @param string $scheme
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $format = "%s://%s";
        $args = array($this->scheme, $this->host);
        if ($this->port != 0) {
            $format .= ":%d";
            array_push($args, $this->port);
        }
        if ($this->path != "") {
            $format .= "%s";
            array_push($args, $this->path);
        }

        return vsprintf($format, $args);
    }


}