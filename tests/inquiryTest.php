<?php

use Cars\Controllers\Inquires;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;

require 'cars/controllers/inquires.php';
require_once 'classes/databasetable.php';

class InquiryTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $inquiresTable = new DatabaseTable($pdo, 'inquires', 'id');
        $this->controller = new Inquires($inquiresTable);
    }
}