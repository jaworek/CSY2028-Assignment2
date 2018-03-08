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
        if (!isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] == true) {
            header('Location: login');
        }

        return [
            'template' => 'admin/admin.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    public function login($error = [])
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

    public function checkCredentials()
    {
        $error = [];

        if (empty($_POST['email'])) {
            $error[] = 'Email cannot be empty';
        } else if (empty($_POST['password'])) {
            $error[] = 'Password cannot be empty';
        } else {
            $user = $this->adminsTable->find('email', $_POST['email']);

            if (!empty($user)) {
                $user = $user[0];

                if (password_verify($_POST['password'], $user['password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['name'] = $user['name'];
                    header('Location: admin');
                    exit();
                }
            }
        }

        return $this->login($error);
    }

    public function logout()
    {
        if (isset($_SESSION['loggedin'])) {
            session_destroy();
        }
        header("Location: admin");
    }
}