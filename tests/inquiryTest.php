<?php

use Cars\Controllers\Inquires;
use Classes\Authentication;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;

class InquiryTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $inquiresTable = new DatabaseTable($pdo, 'inquires', 'id');
        $authentication = $this->createMock(Authentication::class);
        $this->controller = new Inquires($inquiresTable, $authentication);
    }

    public function testCompleteSubmit()
    {

    }
}