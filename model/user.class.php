<?php
class User
{
    protected $id, $username, $name, $surname, $password_hash, $role;

    function __construct($id, $username, $name, $surname, $password_hash, $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->surname = $surname;
        $this->password_hash = $password_hash;
        $this->role = $role;
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
