<?php

use Cars\Controllers\News;
use Classes\Authentication;
use Classes\DatabaseTable;
use Classes\Images;
use PHPUnit\Framework\Testcase;

class NewsTest extends Testcase
{
    private $controller;

    public function setUp()
    {
        $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
        $newsTable = new DatabaseTable($pdo, 'news', 'id');
        $adminsTable = new DatabaseTable($pdo, 'admin', 'id');
        $authentication = $this->createMock(Authentication::class);
        $images = new Images();
        $this->controller = new News($newsTable, $adminsTable, $authentication, $images, [], []);
    }

    public function testEmptyTitle()
    {
        $news = [
            'title' => '',
            'content' => 'Bob is a fat hamster.'
        ];

        $errors = $this->controller->validateNews($news);

        $this->assertEquals(count($errors), 1);
    }

    public function testWhitespaceTitle()
    {
        $news = [
            'title' => ' ',
            'content' => 'Bob is a fat hamster.'
        ];

        $errors = $this->controller->validateNews($news);

        $this->assertEquals(count($errors), 1);
    }

    public function testEmptyContent()
    {
        $news = [
            'title' => 'TestTitle',
            'content' => ''
        ];

        $errors = $this->controller->validateNews($news);

        $this->assertEquals(count($errors), 1);
    }

    public function testWhitespaceContent()
    {
        $news = [
            'title' => 'TestTitle',
            'content' => ' '
        ];

        $errors = $this->controller->validateNews($news);

        $this->assertEquals(count($errors), 1);
    }

    public function testEmptyEverything()
    {
        $news = [
            'title' => '',
            'content' => ''
        ];

        $errors = $this->controller->validateNews($news);

        $this->assertEquals(count($errors), 2);
    }

    public function testExistingTitle()
    {
        $news = [
            'title' => 'test',
            'content' => 'Bob is a fat hamster.'
        ];

        $errors = $this->controller->validateNews($news);

        $this->assertEquals(count($errors), 1);
    }

    public function testValidNews()
    {
        $news = [
            'title' => 'TestTitle',
            'content' => 'Bob is a fat hamster.'
        ];

        $errors = $this->controller->validateNews($news);

        $this->assertEquals(count($errors), 0);
    }
}