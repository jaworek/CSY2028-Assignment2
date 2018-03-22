<?php

use Cars\Controllers\Admin;
use Classes\Authentication;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;

class LoginTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $adminsTable = new DatabaseTable($pdo, 'admin', 'id');
        $authentication = $this->createMock(Authentication::class);
        $this->controller = new Admin($authentication);
    }

    public function testEmptyLogin()
    {

    }

    public function testEmptyPassword()
    {

    }

    public function testEmptyEverything()
    {

    }

    public function testIncorrectLogin()
    {

    }

    public function testIncorrectPassword()
    {

    }
}