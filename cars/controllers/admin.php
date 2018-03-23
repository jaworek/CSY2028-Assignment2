<?php

namespace Cars\Controllers;

use Classes\Authentication;

class Admin
{
    private $authentication;
    private $post;

    public function __construct(Authentication $authentication, array $post)
    {
        $this->authentication = $authentication;
        $this->post = $post;
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

    public function login($errors = [])
    {
        return [
            'template' => 'admin/login.html.php',
            'title' => 'Login to admin account',
            'class' => 'admin',
            'variables' => [
                'errors' => $errors
            ]
        ];
    }

    public function processLogin()
    {
        if ($this->authentication->login($this->post['email'], $this->post['password'])) {
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