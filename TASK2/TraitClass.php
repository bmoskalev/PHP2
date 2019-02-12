<?php
include "trait.php";

class TraitClass
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