<?php

use Cars\Controllers\News;
use Classes\DatabaseTable;
use PHPUnit\Framework\Testcase;

require 'cars/controllers/news.php';
require_once 'classes/databasetable.php';

class NewsTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $newsTable = new DatabaseTable($pdo, 'news', 'id');
        $this->controller = new News($newsTable);
    }
}