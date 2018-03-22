<?php

use Cars\Controllers\Staff;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;

require 'cars/controllers/manufacturers.php';
require_once 'classes/databasetable.php';

class ManufacturerTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id');
        $this->controller = new Staff($manufacturersTable);
    }

    public function testEmptyManufacturer()
    {
        $variable = false;

        $this->assertIsTrue($variable);
    }
}