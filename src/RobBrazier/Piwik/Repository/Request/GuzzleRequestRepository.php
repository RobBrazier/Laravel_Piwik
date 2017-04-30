<?php

namespace RobBrazier\Piwik\Repository\Request;


use GuzzleHttp\ClientInterface;
use Lightools\Xml\XmlLoader;
use RobBrazier\Piwik\Repository\ConfigRepository;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;
use RobBrazier\Piwik\Traits\ConfigTrait;
use RobBrazier\Piwik\Traits\FormatTrait;
use Sabre\Xml;

class GuzzleRequestRepository implements RequestRepository {

    use ConfigTrait {
        ConfigTrait::__construct as private __configConstruct;
    }
    use FormatTrait;

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ConfigRepository $config, ClientInterface $client)
    {
        $this->__configConstruct($config);
        $this->client = $client;
    }

    /**
     * @inheritdoc
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
        $options = [
            "timeout" => $this->config->get('curl_timeout', 5.0),
            "verify" => $this->config->get('verify_peer', true),
            "base_uri" => $this->getPiwikUrl()
        ];
        $response = $this->client->request("get", $url, $options);
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
            case 'xml':
                $loader = new XmlLoader();
                $domDocument = $loader->loadXml($result);
                $result = simplexml_import_dom($domDocument);
        };
        return $result;
    }
}