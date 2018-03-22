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
        $this->controller = new Page($inquiresTable, $newsTable, $adminsTable);
    }

    public function testEmptyName()
    {
        
    }

    public function testEmptyEmail()
    {

    }

    public function testInvalidEmail()
    {

    }

    public function testEmptyTelephone()
    {
        
    }

    public function testTelephoneNaN()
    {
        
    }

    public function testEmptyInquiry()
    {
        
    }

    public function testEmptyEverything()
    {
        
    }

    public function testValidInquiry()
    {

    }
}