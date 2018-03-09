<?php

namespace Cars\Controllers;

use Classes\Authentication;

class Admin
{
    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function admin()
    {
        return [
            'template' => 'admin/admin.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    public function login($error = false)
    {
        return [
            'template' => 'admin/login.html.php',
            'title' => 'Login to admin account',
            'class' => 'admin',
            'variables' => [
                'error' => $error
            ]
        ];
    }

    public function processLogin()
    {
        if ($this->authentication->login($_POST['email'], $_POST['password'])) {
            header('Location: admin');
            exit();
        }

        $error = true;
        return $this->login($error);
    }

    public function logout()
    {
        session_destroy();
        header("Location: login");
    }
}