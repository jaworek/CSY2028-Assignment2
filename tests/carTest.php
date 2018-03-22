<?php

use Cars\Controllers\Cars;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;

require 'cars/controllers/cars.php';
require_once 'classes/databasetable.php';

class CarTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $carsTable = new DatabaseTable($pdo, 'cars', 'id');
        $this->controller = new Cars($carsTable);
    }
}