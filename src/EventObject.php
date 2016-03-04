<?php

namespace Netsells\Calendar;

class EventObject
{
    protected $start;
    protected $end;
    protected $summary;
    protected $location;
    protected $no_time = false;

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->{$property} = $value;
        }
    }

    public function toArray()
    {
        $array = [];

        foreach(get_object_vars($this) as $property => $value) {
            $array[$property] =  $value;
        }

        return $array;
    }

}