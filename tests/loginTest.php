<?php

use Cars\Controllers\Admin;
use Classes\Authentication;
use PHPUnit\Framework\Testcase;

class LoginTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $authentication = $this->createMock(Authentication::class);
        $this->controller = new Admin($authentication, []);
    }

    public function testEmptyLogin()
    {
        $credentials = [
            'login' => '',
            'password' => 'bob'
        ];


    }

    public function testEmptyPassword()
    {
        $credentials = [
            'login' => '',
            'password' => ''
        ];
    }

    public function testEmptyEverything()
    {
        $credentials = [
            'login' => '',
            'password' => ''
        ];
    }

    public function testIncorrectLogin()
    {
        $credentials = [
            'login' => 'edek',
            'password' => 'bob'
        ];
    }

    public function testIncorrectPassword()
    {
        $credentials = [
            'login' => 'bob',
            'password' => 'edek'
        ];
    }

    public function testValidLogin()
    {
        $credentials = [
            'login' => 'bob',
            'password' => 'bob'
        ];
    }
}