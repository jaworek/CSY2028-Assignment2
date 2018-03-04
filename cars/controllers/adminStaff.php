<?php

namespace Cars\Controllers;

class AdminStaff
{
    private $adminsTable;

    public function __construct($adminsTable)
    {
        $this->adminsTable = $adminsTable;
    }

    private function isLogged()
    {
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
            header("Location: /admin/admin");
            exit();
        }
    }

    public function staff()
    {
        $staff = $this->adminsTable->findAll();

        return [
            'template' => 'admin/staff.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'staff' => $staff
            ]
        ];
    }

    public function addStaff()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {
            $password = $_POST['staff']['password'];
            $password2 = $_POST['password2'];

            if ($password === $password2) {
                $_POST['staff']['password'] = password_hash($password, PASSWORD_DEFAULT);
                $this->adminsTable->save($_POST['staff']);
            }
        }

        return [
            'template' => 'admin/addstaff.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    public function editStaff()
    {

    }

    public function deleteStaff()
    {
        return [
            'template' => 'admin/delete.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => 'staff',
                'id' => $_GET['id']
            ]
        ];
    }
}