<?php

namespace Cars\Entities;

use Classes\DatabaseTable;

class Manufacturer
{
    public $id;
    public $name;

    private $carsTable;
    private $cars;

    public function __construct(DatabaseTable $carsTable)
    {
        $this->carsTable = $carsTable;
    }

    public function getCars()
    {
        if (empty($this->cars)) {
            $this->cars = $this->carsTable->find('manufacturer_id', $this->id);
        }

        return $this->cars;
    }

    public function countCars()
    {
        return $this->carsTable->count('manufacturer_id', $this->id);
    }
}