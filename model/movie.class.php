<?php
class Movie
{
    protected $id, $name, $url, $description;

    function __construct($id, $name, $url, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->description = $description;
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
