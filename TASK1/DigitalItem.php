<?php

require "Item.php";

class DigitalItem extends Item
{
    //Функция возвращает цену товара
    public function getPrice()
    {
        return self::defaultPrice / 2;
    }

    //Функция возвращает стоимость товара товара количеством $quantity
    public function getCost($quantity)
    {
        if (is_int($quantity)) {
            return $this->getPrice() * $quantity;
        } else {
            return null;
        }
    }

}
