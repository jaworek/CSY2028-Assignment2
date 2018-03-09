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
    private $adminsTable;
    private $manufacturersTable;

    public function __construct(DatabaseTable $adminsTable, DatabaseTable $manufacturersTable)
    {
        $this->adminsTable = $adminsTable;
        $this->manufacturersTable = $manufacturersTable;
    }

    public function getAdmin()
    {
        return $this->adminsTable->findById($this->adminId);
    }

    public function getManufacturer()
    {
        return $this->manufacturersTable->findById($this->manufacturerId);
    }
}