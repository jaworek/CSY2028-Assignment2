<?php

use Cars\Controllers\Staff;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;

class StaffTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $adminsTable = new DatabaseTable($pdo, 'admin', 'id');
        $this->controller = new Staff($adminsTable);
    }

    public function testEmptyEmail()
    {

    }

    public function testNotValidEmail()
    {

    }

    public function testEmptyPassword()
    {
        
    }

    public function testEmptyPasswordRepeat()
    {

    }

    public function testEmptyName()
    {

    }

    public function testEmptyEverything()
    {

    }

    public function testPasswordsNotMatching()
    {

    }

    public function testValidDetails()
    {

    }
}