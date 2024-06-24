<?php

class HomeController
{
    public $message = "";
    function index()
    {
        $title = 'HOME';

        require_once __DIR__ . '/../view/home.php';
    }
}
