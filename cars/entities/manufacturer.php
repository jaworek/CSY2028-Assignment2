<?php

namespace Cars\Entities;

use Classes\DatabaseTable;

class Manufacturer
{
    public $id;
    public $name;
    private $manufacturersTable;

    public function __construct(DatabaseTable $manufacturersTable)
    {
        $this->manufacturersTable = $manufacturersTable;
    }

    public function getManufacturer()
    {

    }

}