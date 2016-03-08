<?php

namespace Netsells\Calendar;

use Netsells\Calendar\Exceptions\EventNotFoundException;

class Event
{
    protected $request;
    protected $calendarId;
    protected $eventId;

    public function __construct($calendarId, $eventId = null, EventObject $data = null)
    {
        $this->request = new Request();
        $this->calendarId = $calendarId;
        $this->eventId = $eventId;

        if ($this->eventId === null) {
            $this->create($data);
        }
    }

    public function create($data)
    {
        $request = $this->request->put("calendars/{$this->calendarId}/events", [
            'auth' => true,
            'body' => $data->toArray(),
        ]);

        $this->eventId = json_decode($request->getBody()->getContents())->data->id;

        return $this;
    }

    public function update($data)
    {
        $request = $this->request->post("calendars/{$this->calendarId}/events/{$this->eventId}", [
            'auth' => true,
            'body' => $data->toArray(),
        ]);

        $this->eventId = json_decode($request->getBody()->getContents())->data->id;

        return $this;

    }

    public function delete()
    {
        try {
            $request = $this->request->delete("calendars/{$this->calendarId}/events/{$this->eventId}", [
                'auth' => true,
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();

            if ($statusCode === 410) {
                return true;
            }

            if ($statusCode === 404) {
                throw new EventNotFoundException("Event {$this->eventId} could not be found on calendar {$this->calendarId}");
            }

            throw $e;
        }
    }

    public function getEventId()
    {
      return $this->eventId;
    }
}
