<?php

require "Item.php";

class DigitalItem extends Item
{
    public function getPrice()
    {
        return self::defaultPrice / 2;
    }

    public function getCost($quantity)
    {
        if (is_int($quantity)) {
            return $this->getPrice() * $quantity;
        } else {
            return null;
        }
    }

}
