<?php

namespace Netsells\Calendar;

class EventObject
{
    protected $start;
    protected $end;
    protected $summary;
    protected $location;
    protected $no_time = false;
    protected $repeat = [];

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
            if (is_array($value)) {
                foreach ($value as $subProperty => $subValue) {
                    $array["{$property}.{$subProperty}"] = $subValue;
                }
            } else {
                $array[$property] =  $value;
            }
        }

        return $array;
    }

}
