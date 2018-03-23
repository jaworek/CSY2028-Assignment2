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
        $this->controller = new Staff($adminsTable, [], []);
    }

    public function testEmptyEmail()
    {
        $staff = [
            'email' => '',
            'password' => 'bob',
            'password2' => 'bob',
            'name' => 'Bob'
        ];

        $errors = $this->controller->validateStaff($staff);

        $this->assertEquals(count($errors), 1);
    }

    public function testNotValidEmail()
    {
        $staff = [
            'email' => 'bobgmailcom',
            'password' => 'bob',
            'password2' => 'bob',
            'name' => 'Bob'
        ];

        $errors = $this->controller->validateStaff($staff);

        $this->assertEquals(count($errors), 1);
    }

    public function testEmptyPassword()
    {
        $staff = [
            'email' => 'bob@gmail.com',
            'password' => '',
            'password2' => 'bob',
            'name' => 'Bob'
        ];

        $errors = $this->controller->validateStaff($staff);

        $this->assertEquals(count($errors), 1);
    }

    public function testWhitespacePassword()
    {

    }

    public function testEmptyPasswordRepeat()
    {
        $staff = [
            'email' => 'bob@gmail.com',
            'password' => 'bob',
            'password2' => '',
            'name' => 'Bob'
        ];

        $errors = $this->controller->validateStaff($staff);

        $this->assertEquals(count($errors), 1);
    }

    public function testWhitespacePasswordRepeat()
    {

    }

    public function testEmptyName()
    {
        $staff = [
            'email' => 'bob@gmail.com',
            'password' => 'bob',
            'password2' => 'bob',
            'name' => ''
        ];

        $errors = $this->controller->validateStaff($staff);

        $this->assertEquals(count($errors), 1);
    }

    public function testEmptyEverything()
    {
        $staff = [
            'email' => '',
            'password' => '',
            'password2' => '',
            'name' => ''
        ];

        $errors = $this->controller->validateStaff($staff);

        $this->assertEquals(count($errors), 3);
    }

    public function testPasswordsNotMatching()
    {
        $staff = [
            'email' => 'bob@gmail.com',
            'password' => 'bob',
            'password2' => 'edward',
            'name' => 'Bob'
        ];

        $errors = $this->controller->validateStaff($staff);

        $this->assertEquals(count($errors), 1);
    }

    public function testStaffExists()
    {

    }

    public function testValidDetails()
    {
        $staff = [
            'email' => 'bob@gmail.com',
            'password' => 'bob',
            'password2' => 'bob',
            'name' => 'Bob'
        ];

        $errors = $this->controller->validateStaff($staff);

        $this->assertEquals(count($errors), 0);
    }

    public function testSubmitStaff()
    {

    }

    public function testDeleteStaff()
    {

    }
}