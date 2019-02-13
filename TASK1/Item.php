<?php

abstract class Item
{
    protected $id;
    protected $name;
    const defaultPrice = 100;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function setId($id)
    {
        $this->id = $id;

    }

    public function getId()
    {
        return $this->id;

    }

    public function setName($name)
    {
        $this->name = $name;

    }

    public function getName()
    {
        return $this->name;

    }

    abstract public function getPrice();
    abstract public function getCost($quantity);
}
