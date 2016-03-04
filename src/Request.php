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

    public function delete($url, $options = [])
    {
        return $this->request($url, $options, 'DELETE');
    }

    protected function request($url, $options = [], $method = "GET")
    {
        $headers = [];

        if (isset($options['auth']) and $options['auth'] === true) {
            $headers['Authorization'] = $this->god->getAccountId();
        }

        return $this->httpClient->request($method, $url, [
            'headers' => $headers,
        ]);
    }
}