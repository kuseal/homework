<?php

  class Car
  {

    public $name;
    public $color = 'Черный';
    public $price;

    public function getPice($price, $discount, $color)
    {
      $this->color = $color;
      $this->price = $price;
      if ($this->color == 'Белый') {
        return $this->price - round($this->price * $discount / 100);

      } else {
        return $this->price;
      }
    }
  }

  $bmw = new Car();
  $audi = new Car();

  $audi->name = 'Audi';
  $audi->color = 'Белый';
  $bmw->name = 'BMW';
  $bmw->color;

  $bmw->getPice(1550000, 10, $bmw->color);
  $audi->getPice(3190000, 10, $audi->color);


  class TV
  {
    public $name;
    public $price;

    public function getPrice()
    {
      $this->price;
      return $this->price;
    }
  }

  $philips = new TV();
  $sharp = new TV();

  $philips->name = 'Philips';
  $philips->price = '20000';

  $sharp->name = 'Sharp';
  $sharp->price = '30000';


  class BallPen
  {
    public $name;
    protected $price = 100;

    public function getPrice()
    {
      return $this->price;
    }
  }

  $pen = new BallPen();
  $pen->name = 'Шариковая ручка';
  $price = $pen->getPrice();

  class Duck
  {
    protected $name = 'Утка';
    public $breed;

    public function getName()
    {
      return $this->name;
    }
  }

  $duck = new Duck();
  $name = $duck->getName();
  $duck->breed = 'Мускусная';

  class Product
  {
    public $name;
    public $discount;
    public $price;

    public function __construct($name, $price, $discount)
    {
      $this->name = $name;
      $this->price = $price;
      $this->discount = $discount;
    }

    public function getPrice()
    {
      return $this->discount ? ($this->price * (1 - $this->discount * 2 / 100)) : $this->price;
    }
  }
  $tv = new Product('Sharp', 30000, 15);
  $car = new Product('Audi', 3200000, 5);
  $price = $car->getPrice();

