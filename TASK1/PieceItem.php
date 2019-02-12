<?php

require "DigitalItem.php";

class PieceItem extends DigitalItem{

    public function getPrice()
    {
        return self::defaultPrice;
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
