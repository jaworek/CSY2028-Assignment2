<?php

use Cars\Controllers\Page;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;

class PageTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $inquiresTable = new DatabaseTable($pdo, 'inquires', 'id');
        $newsTable = new DatabaseTable($pdo, 'news', 'id');
        $adminsTable = new DatabaseTable($pdo, 'admin', 'id');
        $this->controller = new Page($inquiresTable, $newsTable, $adminsTable, [], []);
    }

    public function testEmptyName()
    {
        $inquiry = [
            'message' => 'Hello',
            'email' => 'bob@gmail.com',
            'name' => '',
            'telephone' => '321567854',
            'admin_id' => ''
        ];

        $errors = $this->controller->validateInquiry($inquiry);

        $this->assertEquals(count($errors), 1);
    }

    public function testEmptyEmail()
    {
        $inquiry = [
            'message' => 'Hello',
            'email' => '',
            'name' => 'Eduardo',
            'telephone' => '321567854',
            'admin_id' => ''
        ];

        $errors = $this->controller->validateInquiry($inquiry);

        $this->assertEquals(count($errors), 1);
    }

    public function testInvalidEmail()
    {
        $inquiry = [
            'message' => 'Hello',
            'email' => 'bobgmailcom',
            'name' => 'Eduardo',
            'telephone' => '321567854',
            'admin_id' => ''
        ];

        $errors = $this->controller->validateInquiry($inquiry);

        $this->assertEquals(count($errors), 1);
    }

    public function testEmptyTelephone()
    {
        $inquiry = [
            'message' => 'Hello',
            'email' => 'bob@gmail.com',
            'name' => 'Eduardo',
            'telephone' => '',
            'admin_id' => ''
        ];

        $errors = $this->controller->validateInquiry($inquiry);

        $this->assertEquals(count($errors), 1);
    }

    public function testTelephoneNaN()
    {
        $inquiry = [
            'message' => 'Hello',
            'email' => 'bob@gmail.com',
            'name' => 'Eduardo',
            'telephone' => 'aaaa',
            'admin_id' => ''
        ];
    }

    public function testEmptyMessage()
    {
        $inquiry = [
            'message' => '',
            'email' => 'bob@gmail.com',
            'name' => 'Eduardo',
            'telephone' => '321567854',
            'admin_id' => ''
        ];

        $errors = $this->controller->validateInquiry($inquiry);

        $this->assertEquals(count($errors), 1);
    }

    public function testEmptyEverything()
    {
        $inquiry = [
            'message' => '',
            'email' => '',
            'name' => '',
            'telephone' => '',
            'admin_id' => ''
        ];

        $errors = $this->controller->validateInquiry($inquiry);

        $this->assertEquals(count($errors), 4);
    }

    public function testValidInquiry()
    {
        $inquiry = [
            'message' => 'Hello',
            'email' => 'bob@gmail.com',
            'name' => 'Eduardo',
            'telephone' => '321567854',
            'admin_id' => ''
        ];

        $errors = $this->controller->validateInquiry($inquiry);

        $this->assertEquals(count($errors), 0);
    }

    public function testSubmitInquiry()
    {

    }
}