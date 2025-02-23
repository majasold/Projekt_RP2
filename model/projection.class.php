<?php
class Projection implements JsonSerializable
{
    protected $id_projection, $id_hall, $id_movie, $date, $time, $regular_price;

    function __construct($id_projection, $id_hall, $id_movie, $date, $time, $regular_price)
    {
        $this->id_projection = $id_projection;
        $this->id_hall = $id_hall;
        $this->id_movie = $id_movie;
        $this->date = $date;
        $this->time = $time;
        $this->regular_price = $regular_price;
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

    public function jsonSerialize()
    {
        return [
            'id_projection' => $this->id_projection,
            'id_hall' => $this->id_hall,
            'id_movie' => $this->id_movie,
            'date' => $this->date,
            'time' => $this->time,
            'regular_price' => $this->regular_price
        ];
    }
}
