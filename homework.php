<?php
// Задание 1-4
// Класс описывающий сущность обувь.
class Shoes
{
    private $id; //артикул
    private $brand; //бренд
    private $size; //размер
    private $weight; //вес
    private $count; //количество

    public function __construct($id, $brand, $size, $weight, $count)
    {
        $this->id = $id;
        $this->brand = $brand;
        $this->size = $size;
        $this->weight = $weight;
        $this->count = $count;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setId($count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }
}

class Boots extends Shoes{
    private $type;
    public function __construct($id, $brand, $size, $weight, $count, $type)
    {
        parent::__construct($id, $brand, $size, $weight, $count);
        $this->type=$type;
    }
}


//Задание 5
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

$a1 = new A();
$a2 = new A();
$a1->foo(); //1
$a2->foo(); //2
$a1->foo(); //3
$a2->foo(); //4
//В данном случае $a1 и $b1 это экземпляры одного класса и у них одна общая статическая переменная $x.
//Поэтому при вызове метода foo эта переменная каждыц раз будет увеличивать на 1 и выводиться на экран
//

//Задание 6
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

class B extends A
{
}

$a1 = new A();
$b1 = new B();
$a1->foo(); //1
$b1->foo(); //1
$a1->foo(); //2
$b1->foo(); //2
//В данном случае $a1 и $b1 это экземпляры разных классов (родителя и наследника). У них $x это разные переменные
// из разных классов.
//Поэтому при вызове метода foo эта переменная каждыц раз будет увеличивать на 1 только в своем классе A или B
// и выводиться на экран
//

//Задание 7
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

class B extends A
{
}

$a1 = new A;
$b1 = new B;
$a1->foo(); //1
$b1->foo(); //1
$a1->foo(); //2
$b1->foo(); //2
//В данном случае $a1 и $b1 это экземпляры разных классов (родителя и наследника). У них $x это разные переменные
// из разных классов. Отсутствие скобок никак не влияет потому что нет входных паарметров дял констуктора
//Поэтому при вызове метода foo эта переменная каждыц раз будет увеличивать на 1 только в своем классе A или B
// и выводиться на экран
