<?php

namespace Cars\Controllers;
class Account
{
    private $adminsTable;

    public function __construct($adminsTable)
    {
        $this->adminsTable = $adminsTable;
    }

    private function login()
    {
        if (isset($_POST['submit'])) {
            $user = $this->adminsTable->find('email', $_POST['email'])[0];

            if ($_POST['password'] == $user['password']) {
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
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
}