<?php

use PHPUnit\Framework\Testcase;

require 'cars/controllers/manufacturers.php';
require 'classes/databasetable.php';

class ManufacturerTest extends Testcase
{
    public function testEmptyManufacturer()
    {
        $variable = false;

        $this->assertIsTrue($variable);
    }
}