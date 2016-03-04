<?php

namespace Netsells\Calendar;

class God
{
    protected $accountId;
    protected $url;

    public function __construct()
    {
        $this->accountId = getenv('AWESOMECAL_ACCOUNTID');
        $this->url = getenv('AWESOMECAL_SERVERURL');
    }

    public function getAccountId()
    {
        return $this->accountId;
    }

    public function getUrl()
    {
        return $this->url;
    }
}