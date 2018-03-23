<?php

namespace Cars\Controllers;

use Classes\DatabaseTable;

class Staff
{
    private $adminsTable;
    private $get;
    private $post;

    public function __construct(DatabaseTable $adminsTable, array $get, array $post)
    {
        $this->adminsTable = $adminsTable;
        $this->get = $get;
        $this->post = $post;
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

    public function addStaff($errors = [])
    {
        return [
            'template' => 'admin/addstaff.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'errors' => $errors
            ]
        ];
    }

    public function validateStaff($staff)
    {
        $errors = [];

        if (empty($staff['email'])) {
            $errors[] = 'Email cannot be empty';
        } else if (!filter_var($staff['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email is not valid';
        }

        if (empty($staff['password']) || empty($staff['password2'])) {
            $errors[] = 'Passwords cannot be empty';
        } else if ($staff['password'] !== $staff['password2']) {
            $errors[] = 'Passwords do not match';
        }

        if (empty($staff['name'])) {
            $errors[] = 'Name cannot be empty';
        }

        return $errors;
    }

    public function saveStaff()
    {
        $errors = $this->validateStaff($this->post['staff']);

        if (count($errors) == 0) {
            $this->post['staff']['password'] = password_hash($this->post['staff']['password'], PASSWORD_DEFAULT);
            $this->adminsTable->save($this->post['staff']);
            header('Location: staff');
        }

        return $this->addStaff($errors);


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
                'id' => $this->get['id']
            ]
        ];
    }

    public function processDelete()
    {
        $this->adminsTable->delete('id', $this->get['id']);
        header('Location: staff');
    }
}