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

    public function modifyManufacturer($error = false)
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
                'error' => $error
            ]
        ];
    }

    public function saveManufacturer()
    {
        $error = false;
        $record['name'] = $_POST['name'];

        if (isset($_GET['id'])) {
            $record['id'] = $_GET['id'];
        }

        if (empty($_POST['name'])) {
            $error = true;
        }

        if (!$error) {
            $this->manufacturersTable->save($record);
            header('Location: manufacturers');
            exit();
        }

        return $this->modifyManufacturer($error);
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