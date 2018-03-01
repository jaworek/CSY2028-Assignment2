<?php

namespace Cars\Controllers;

class AdminManufacturers
{
    private $manufacturersTable;

    public function __construct($manufacturersTable)
    {
        $this->manufacturersTable = $manufacturersTable;
    }

    private function isLogged()
    {
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
            header("Location: /admin/admin");
            exit();
        }
    }

    public function manufacturers()
    {
        $this->isLogged();
        $manufacturers = $this->manufacturersTable->findAll();

        return [
            'template' => 'admin/manufacturers.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'categories' => $manufacturers
            ]
        ];
    }

    public function addManufacturer()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {

            $record = [
                'name' => $_POST['name']
            ];

            $this->manufacturersTable->insert($record);
        }

        return [
            'template' => 'admin/modifymanufacturer.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => 'Add'
            ]
        ];
    }

    public function editManufacturer()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {

            $record = [
                'name' => $_POST['name'],
                'id' => $_POST['id']
            ];

            $this->manufacturersTable->update($record);

        }

        $manufacturer = $this->manufacturersTable->find('id', $_GET['id'])[0];

        return [
            'template' => 'admin/modifymanufacturer.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => 'Edit',
                'manufacturer' => $manufacturer
            ]
        ];
    }

    public function deleteManufacturer()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {
            $this->manufacturersTable->delete('id', $_GET['id']);
            header('Location: manufacturers');
        }

        return [
            'template' => 'admin/delete.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => 'manufacturer',
                'id' => $_GET['id']
            ]
        ];
    }
}