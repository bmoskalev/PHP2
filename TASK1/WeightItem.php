<?php

require "Item.php";

class WeightItem extends Item{

    public function getPrice()
    {
        return self::defaultPrice;
    }

    public function getCost($quantity)
    {
            return $this->getPrice() * $quantity;
    }

}