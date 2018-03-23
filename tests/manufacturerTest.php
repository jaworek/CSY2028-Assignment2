<?php

use Cars\Controllers\Manufacturers;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;


class ManufacturerTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id');
        $this->controller = new Manufacturers($manufacturersTable, [], []);
    }

    public function testEmptyManufacturer()
    {
        $manufacturer = [
            'name' => ''
        ];

        $errors = $this->controller->validateManufacturer($manufacturer);

        $this->assertEquals(count($errors), 1);
    }

    public function testWhitespaceManufacturer()
    {
        $manufacturer = [
            'name' => ' '
        ];

        $errors = $this->controller->validateManufacturer($manufacturer);

        $this->assertEquals(count($errors), 1);
    }

    public function testManufacturerExists()
    {
        $manufacturer = [
            'name' => 'Jaguar'
        ];

        $errors = $this->controller->validateManufacturer($manufacturer);

        $this->assertEquals(count($errors), 1);
    }

    public function testValidManufacturer()
    {
        $manufacturer = [
            'name' => 'TestManufacturer'
        ];

        $errors = $this->controller->validateManufacturer($manufacturer);

        $this->assertEquals(count($errors), 0);
    }

    public function testSubmitManufacturer()
    {

    }

    public function testDeleteManufacturer()
    {
        $manufacturer = [
            'name' => 'TestManufacturer'
        ];
    }
}