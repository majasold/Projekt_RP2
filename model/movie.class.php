<?php
class Movie
{
    protected $id, $name, $url;

    function __construct($id, $name, $url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
    }

    function __get($property)
    {
        if (property_exists($this, $property))
            return $this->$property;
    }

    function __set($property, $value)
    {
        if (property_exists($this, $property))
            $this->$property = $value;

        return $this;
    }
}
