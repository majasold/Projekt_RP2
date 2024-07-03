<?php
class Reservation
{
    protected $id_reservation, $id_user, $id_projection, $row, $col, $price, $created;

    function __construct($id_reservation, $id_user, $id_projection, $row, $col, $price, $created)
    {
        $this->id_reservation = $id_reservation;
        $this->id_user = $id_user;
        $this->id_projection = $id_projection;
        $this->row = $row;
        $this->col = $col;
        $this->price = $price;
        $this->created = $created;
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
