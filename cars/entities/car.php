<?php

namespace Cars\Entities;

use Classes\DatabaseTable;

class Car
{
    public $id;
    public $name;
    public $price;
    public $earlier_price;
    public $manufacturer_id;
    public $description;
    public $archived;
    public $mileage;
    public $engine_type;
    public $production_year;
    public $admin_id;

    private $adminsTable;
    private $manufacturersTable;
    private $admin;
    private $manufacturer;

    public function __construct(DatabaseTable $adminsTable, DatabaseTable $manufacturersTable)
    {
        $this->adminsTable = $adminsTable;
        $this->manufacturersTable = $manufacturersTable;
    }

    public function getAdmin()
    {
        if (empty($this->admin)) {
            $this->admin = $this->adminsTable->findById($this->admin_id);
        }

        return $this->admin;
    }

    public function getManufacturer()
    {
        if (empty($this->manufacturer)) {
            $this->manufacturer = $this->manufacturersTable->findById($this->manufacturer_id);
        }

        return $this->manufacturer;
    }
}