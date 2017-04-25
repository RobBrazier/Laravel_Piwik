<?php
/**
 * Created by IntelliJ IDEA.
 * User: Rob
 * Date: 23/04/2017
 * Time: 22:28
 */

namespace RobBrazier\Piwik\Query;


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
        $parsed_url = parse_url($url);
        $this->scheme = $this->getPart($parsed_url, 'scheme');
        $this->host = $this->getPart($parsed_url, 'host');
        $this->port = $this->getPart($parsed_url, 'port', 0);
        $this->path = $this->getPart($parsed_url, 'path');
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