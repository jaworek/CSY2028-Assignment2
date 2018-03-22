<?php

namespace Cars\Controllers;

use Classes\DatabaseTable;

class Manufacturers
{
    private $manufacturersTable;

    public function __construct(DatabaseTable $manufacturersTable)
    {
        $this->manufacturersTable = $manufacturersTable;
    }

    public function manufacturers()
    {
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

    public function validateManufacturer($manufacturer)
    {
        $errors = [];

        if (empty($manufacturer['name'])) {
            $errors[] = 'Manufacturer name cannot be empty';
        }

        $exists = $this->manufacturersTable->find('name', $manufacturer['name']);

        if (count($exists) > 0) {
            $errors[] = 'This name is already in use';
        }

        return $errors;
    }

    public function modifyManufacturer($errors = [])
    {
        if (isset($_GET['id'])) {
            $manufacturer = $this->manufacturersTable->find('id', $_GET['id'])[0];
        }

        return [
            'template' => 'admin/modifymanufacturer.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => (isset($_GET['id'])) ? 'Edit' : 'Add',
                'manufacturer' => $manufacturer ?? '',
                'errors' => $errors
            ]
        ];
    }

    public function saveManufacturer()
    {
        $record['name'] = $_POST['name'];

        if (isset($_GET['id'])) {
            $record['id'] = $_GET['id'];
        }

        $errors = $this->validateManufacturer($record);

        if (count($errors) == 0) {
            $this->manufacturersTable->save($record);
            header('Location: manufacturers');
            exit();
        }

        return $this->modifyManufacturer($errors);
    }

    public function deleteManufacturer()
    {
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

    public function processDelete()
    {
        $this->manufacturersTable->delete('id', $_GET['id']);
        header('Location: manufacturers');
    }
}