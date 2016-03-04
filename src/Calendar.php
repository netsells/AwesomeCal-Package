<?php

namespace Netsells\Calendar;

class Calendar
{
    private $request;
    protected $id;
    protected $download = '';

    public function __construct($id = null)
    {
        $this->request = new Request();
        $this->id = $id;

        if ($this->id === null) {
            $this->create();
        }

        $this->get();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDownload()
    {
        return $this->download;
    }

    protected function create()
    {
        $response = $this->request->put('calendars', [
            'auth' => true,
        ])
            ->getBody()
            ->getContents();

        $this->id = json_decode($response)->data->id;
    }

    public function delete()
    {
        $request = $this->request->delete("calendars/{$this->id}", [
            'auth' => true,
        ]);

        return true;
    }

    protected function get()
    {
        $this->download = $this->request->get("calendars/{$this->id}", [
            'auth' => true,
        ])
            ->getBody()
            ->getContents();
    }
}