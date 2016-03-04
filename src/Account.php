<?php

namespace Netsells\Calendar;

class Account
{
    protected $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function create($name)
    {
        // TODO: Not implemented in API
    }

    public function getCalendars()
    {
        $response = $this->request->get('account/calendars', [
            'auth' => true,
        ])
            ->getBody()
            ->getContents();

        return json_decode($response)->data;
    }
}