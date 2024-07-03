<?php
class Hall
{
    protected $id_hall, $nr_rows, $nr_cols;

    function __construct($id_hall, $nr_rows, $nr_cols)
    {
        $this->id_hall = $id_hall;
        $this->nr_rows = $nr_rows;
        $this->nr_cols = $nr_cols;
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
