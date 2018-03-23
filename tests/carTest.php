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
        $this->controller = new Cars($carsTable, $manufacturersTable, $authentication, $images, [], []);
    }

    public function testEmptyModel()
    {
        $car = [
            'name' => '',
            'price' => '12500',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => 'Very nice car for young lady!',
            'archived' => 'false',
            'mileage' => '5000',
            'engine_type' => 'Diesel',
            'production_year' => '2010',
            'admin_id' => '6'
        ];

        $errors = $this->controller->validateCar($car);

        $this->assertEquals(count($errors), 1);
    }

    public function testEmptyDescription()
    {
        $car = [
            'name' => 'Bob',
            'price' => '12500',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => '',
            'archived' => 'false',
            'mileage' => '5000',
            'engine_type' => 'Diesel',
            'production_year' => '2010',
            'admin_id' => '6'
        ];

        $errors = $this->controller->validateCar($car);

        $this->assertEquals(count($errors), 1);
    }

    public function testEmptyPrice()
    {
        $car = [
            'name' => 'Bob',
            'price' => '',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => 'Very nice car for young lady!',
            'archived' => 'false',
            'mileage' => '5000',
            'engine_type' => 'Diesel',
            'production_year' => '2010',
            'admin_id' => '6'
        ];

        $errors = $this->controller->validateCar($car);

        $this->assertEquals(count($errors), 1);
    }

    public function testPriceNaN()
    {
        $car = [
            'name' => 'Bob',
            'price' => 'aaaa',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => 'Very nice car for young lady!',
            'archived' => 'false',
            'mileage' => '5000',
            'engine_type' => 'Diesel',
            'production_year' => '2010',
            'admin_id' => '6'
        ];
    }

    public function testEmptyMileage()
    {
        $car = [
            'name' => 'Bob',
            'price' => '12500',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => 'Very nice car for young lady!',
            'archived' => 'false',
            'mileage' => '',
            'engine_type' => 'Diesel',
            'production_year' => '2010',
            'admin_id' => '6'
        ];

        $errors = $this->controller->validateCar($car);

        $this->assertEquals(count($errors), 1);
    }

    public function testMileageNaN()
    {
        $car = [
            'name' => 'Bob',
            'price' => '12500',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => 'Very nice car for young lady!',
            'archived' => 'false',
            'mileage' => 'aaaa',
            'engine_type' => 'Diesel',
            'production_year' => '2010',
            'admin_id' => '6'
        ];
    }

    public function testEmptyYear()
    {
        $car = [
            'name' => 'Bob',
            'price' => '12500',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => 'Very nice car for young lady!',
            'archived' => 'false',
            'mileage' => '5000',
            'engine_type' => 'Diesel',
            'production_year' => '',
            'admin_id' => '6'
        ];

        $errors = $this->controller->validateCar($car);

        $this->assertEquals(count($errors), 1);
    }

    public function testYearNaN()
    {
        $car = [
            'name' => 'Bob',
            'price' => '12500',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => 'Very nice car for young lady!',
            'archived' => 'false',
            'mileage' => '5000',
            'engine_type' => 'Diesel',
            'production_year' => 'aaaa',
            'admin_id' => '6'
        ];
    }

    public function testEmptyEverything()
    {
        $car = [
            'name' => '',
            'price' => '',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => '',
            'archived' => 'false',
            'mileage' => '',
            'engine_type' => 'Diesel',
            'production_year' => '',
            'admin_id' => '6'
        ];

        $errors = $this->controller->validateCar($car);

        $this->assertEquals(count($errors), 5);
    }

    public function testCarExists()
    {
        $car = [
            'name' => 'Bob',
            'price' => '12500',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => 'Very nice car for young lady!',
            'archived' => 'false',
            'mileage' => '5000',
            'engine_type' => 'Diesel',
            'production_year' => '2010',
            'admin_id' => '6'
        ];
    }

    public function testValidCar()
    {
        $car = [
            'name' => 'Bob',
            'price' => '12500',
            'earlier_price' => '14000',
            'manufacturer_id' => '3',
            'description' => 'Very nice car for young lady!',
            'archived' => 'false',
            'mileage' => '5000',
            'engine_type' => 'Diesel',
            'production_year' => '2010',
            'admin_id' => '6'
        ];

        $errors = $this->controller->validateCar($car);

        $this->assertEquals(count($errors), 0);
    }

    public function testSubmitCar()
    {

    }

    public function testDeleteCar()
    {

    }
}