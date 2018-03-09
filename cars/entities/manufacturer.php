<?php

namespace Cars\Entities;

use Classes\DatabaseTable;

class Manufacturer
{
    public $id;
    public $name;
    private $carsTable;

    public function __construct(DatabaseTable $carsTable)
    {
        $this->carsTable = $carsTable;
    }

    public function getCars()
    {
        return $this->carsTable->find('manufacturer_id', $this->id);
    }

}