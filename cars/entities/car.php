<?php

namespace Cars\Entities;

use Classes\DatabaseTable;

class Car
{
    public $id;
    public $name;
    public $price;
    public $earlierPrice;
    public $manufacturerId;
    public $description;
    public $archived;
    public $mileage;
    public $engineType;
    public $productionYear;
    public $adminId;
    private $carsTable;

    public function __construct(DatabaseTable $carsTable)
    {
        $this->carsTable = $carsTable;
    }

    public function getCar()
    {

    }

}