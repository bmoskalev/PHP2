<?php

require "DigitalItem.php";

class PieceItem extends DigitalItem
{
    //Функция возвращает цену товара
    public function getPrice()
    {
        return self::defaultPrice;
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
