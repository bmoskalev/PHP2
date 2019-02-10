<?php
include "trait.php";

class someClass
{
    protected static $_instance;

    private function __construct()
    {
    }

    use GetInstance;

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}