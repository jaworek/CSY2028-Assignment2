<?php

use Cars\Controllers\Staff;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;

require 'cars/controllers/staff.php';
require_once 'classes/databasetable.php';

class StaffTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $adminsTable = new DatabaseTable($pdo, 'admin', 'id');
        $this->controller = new Staff($adminsTable);
    }
}