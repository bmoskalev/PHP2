<?php

require "Item.php";

class WeightItem extends Item
{
    //Функция возвращает цену товара
    public function getPrice()
    {
        return self::defaultPrice;
    }
    //Функция возвращает стоимость товара товара c весом $quantity
    public function getCost($quantity)
    {
        return $this->getPrice() * $quantity;
    }

}