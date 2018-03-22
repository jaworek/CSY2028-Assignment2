<?php

namespace Cars\Controllers;

use Classes\DatabaseTable;

class Staff
{
    private $adminsTable;

    public function __construct(DatabaseTable $adminsTable)
    {
        $this->adminsTable = $adminsTable;
    }

    public function staff()
    {
//        FIXME employees without priviliges can access staff page by typing address into the browser
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

    public function addStaff($error = false)
    {
        return [
            'template' => 'admin/addstaff.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'error' => $error
            ]
        ];
    }

    public function validateStaff()
    {

    }

    public function saveStaff()
    {
        $staff = $_POST['staff'];

        $password = $staff['password'];
        $password2 = $_POST['password2'];

        $error = false;

        if (empty($staff['email'])) {
            $error = true;
        } else if (!filter_var($staff['email'], FILTER_VALIDATE_EMAIL)) {
            $error = true;
        } else if (empty($password) || empty($password2)) {
            $error = true;
        } else if (empty($staff['name'])) {
            $error = true;
        } else if ($password !== $password2) {
            $error = true;
        }

        if ($error) {
            return $this->addStaff($error);
        }

        $staff['password'] = password_hash($password, PASSWORD_DEFAULT);
        $this->adminsTable->save($staff);
        header('Location: staff');

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

    public function processDelete()
    {
        $this->adminsTable->delete('id', $_GET['id']);
        header('Location: staff');
    }
}