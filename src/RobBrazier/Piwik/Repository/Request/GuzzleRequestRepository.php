<?php

namespace RobBrazier\Piwik\Repository\Request;


use GuzzleHttp\Client;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;
use RobBrazier\Piwik\Traits\ConfigTrait;
use RobBrazier\Piwik\Traits\FormatTrait;

class GuzzleRequestRepository implements RequestRepository {

    use ConfigTrait;
    use FormatTrait;

    /**
     * @param RequestOptions $requestOptions
     * @return mixed
     */
    public function send(RequestOptions $requestOptions) {
        $body = $this->getResponseBody($requestOptions);
        return $this->decode($body, $requestOptions);
    }

    /**
     * @param RequestOptions $requestOptions
     * @return string
     */
    private function getResponseBody(RequestOptions $requestOptions) {
        $url = 'index.php' . $requestOptions->build($this->config);
        $client = new Client([
            "timeout" => config('piwik.curl_timeout', 5.0),
            "verify" => config('piwik.verify_peer', true),
            "base_uri" => $this->getPiwikUrl()
        ]);
        $response = $client->get($url);
        $body = $response->getBody();
        return $body->getContents();
    }

    /**
     * @param string $result
     * @param RequestOptions $requestOptions
     * @return mixed
     */
    private function decode($result, RequestOptions $requestOptions) {
        $format = $requestOptions->getFormat($this->config);
        switch ($this->validateFormat($format)) {
            case 'json':
                $result = json_decode($result);
                break;
            case 'php':
                $result = unserialize($result);
                break;
        };
        return $result;
    }
}