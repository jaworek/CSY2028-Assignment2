<?php

class AdminController
{
    private $carsTable;
    private $manufacturersTable;

    public function __construct()
    {

    }

    public function admin()
    {
        if (isset($_POST['submit'])) {
            if ($_POST['password'] == 'opensesame') {
                $_SESSION['loggedin'] = true;
            }
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return $this->mainPanel();
        } else {
            return $this->login();
        }
    }

    private function mainPanel()
    {
        return [
            'template' => 'admin/admin.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                $_SESSION['loggedin']
            ]
        ];
    }

    private function login()
    {
        return [
            'template' => 'admin/login.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    public function logout()
    {
        if (isset($_SESSION['loggedin'])) {
            session_destroy();
        }
        header("Location: admin");
        exit();
    }

    public function cars()
    {
        return [
            'template' => 'admin/cars.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    public function manufacturers()
    {
        return [
            'template' => 'admin/manufacturers.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }
}