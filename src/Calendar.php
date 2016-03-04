<?php

namespace Netsells\Calendar;

class Calendar
{
    protected $request;
    protected $id;
    protected $download = '';

    public function __construct($id = null)
    {
        $this->request = new Request();

        if ($id !== null) {
            $this->id = $id;
            $this->get();
        } else {
            $this->create();
            $this->get();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDownload()
    {
        return $this->download;
    }

    public function create()
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