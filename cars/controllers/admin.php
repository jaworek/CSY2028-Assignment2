<?php

namespace Cars\Controllers;
class Admin
{
    private $adminsTable;

    public function __construct($adminsTable)
    {
        $this->adminsTable = $adminsTable;
    }

    public function admin()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return [
                'template' => 'admin/admin.html.php',
                'title' => 'Admin',
                'class' => 'admin',
                'variables' => []
            ];
        } else {
            return $this->login();
        }
    }


    private function login()
    {
        if (isset($_POST['submit'])) {
            $user = $this->adminsTable->find('email', $_POST['email'])[0];

            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['name'];
                header('Location: admin');
            }
        }

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

    private function isLogged()
    {
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
            header("Location: /admin/admin");
            exit();
        }
    }
}