<?php

use Cars\Controllers\Cars;
use Classes\Authentication;
use Classes\DatabaseTable;
use Classes\Images;
use PHPUnit\Framework\Testcase;

class CarTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $carsTable = new DatabaseTable($pdo, 'cars', 'id');
        $manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id');
        $authentication = $this->createMock(Authentication::class);
        $images = new Images();
        $this->controller = new Cars($carsTable, $manufacturersTable, $authentication, $images);
    }

    public function testEmptyModel()
    {

    }

    public function testEmptyDescription()
    {

    }

    public function testEmptyPrice()
    {

    }

    public function testPriceNaN()
    {

    }

    public function testEmptyMileage()
    {
        
    }

    public function testMileageNaN()
    {

    }

    public function testEmptyYear()
    {
        
    }

    public function testYearNaN()
    {

    }

    public function testEmptyEverything()
    {
        
    }

    public function testValidCar()
    {

    }
}