<?php

namespace Cars\Controllers;

use Classes\DatabaseTable;

class Manufacturers
{
    private $manufacturersTable;
    private $get;
    private $post;

    public function __construct(DatabaseTable $manufacturersTable, array $get, array $post)
    {
        $this->manufacturersTable = $manufacturersTable;
        $this->get = $get;
        $this->post = $post;
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
        } else if (preg_match('/^\s+$/', $manufacturer['name'])) {
            $errors[] = 'Manufacturer name cannot contain only whitespace';
        }

        $exists = $this->manufacturersTable->find('name', $manufacturer['name']);

        if (count($exists) > 0) {
            $errors[] = 'This name is already in use';
        }

        return $errors;
    }

    public function modifyManufacturer($errors = [])
    {
        if (isset($this->get['id'])) {
            $manufacturer = $this->manufacturersTable->find('id', $this->get['id'])[0];
        }

        return [
            'template' => 'admin/modifymanufacturer.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => (isset($this->get['id'])) ? 'Edit' : 'Add',
                'manufacturer' => $manufacturer ?? '',
                'errors' => $errors
            ]
        ];
    }

    public function saveManufacturer()
    {
        $record['name'] = $this->post['name'];

        if (isset($this->get['id'])) {
            $record['id'] = $this->get['id'];
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
                'id' => $this->get['id']
            ]
        ];
    }

    public function processDelete()
    {
        $this->manufacturersTable->delete('id', $this->get['id']);
        header('Location: manufacturers');
    }
}