<?php

namespace Netsells\Calendar;

use GuzzleHttp\Client;

class Request
{
    protected $god;
    protected $httpClient;

    public function __construct()
    {
        $this->god = new God();

        $this->httpClient = new Client([
            'base_uri' => $this->god->getUrl(),
        ]);
    }

    public function get($url, $options = [])
    {
        return $this->request($url, $options, 'GET');
    }

    public function put($url, $options = [])
    {
        return $this->request($url, $options, 'PUT');
    }

    public function post($url, $options = [])
    {
        return $this->request($url, $options, 'POST');
    }

    public function delete($url, $options = [])
    {
        return $this->request($url, $options, 'DELETE');
    }

    protected function request($url, $options = [], $method = "GET")
    {
        $requestOptions = [];

        if (isset($options['auth']) and $options['auth'] === true) {
            $requestOptions['headers']['Authorization'] = $this->god->getAccountId();
        }

        if (isset($options['body'])) {
            $requestOptions['json'] = $options['body'];
        }

        return $this->httpClient->request($method, $url, $requestOptions);
    }
}