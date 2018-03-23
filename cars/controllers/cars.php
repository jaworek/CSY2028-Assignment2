<?php

namespace Cars\Controllers;

use Classes\Authentication;
use Classes\DatabaseTable;
use Classes\Images;

class Cars
{
    private $carsTable;
    private $manufacturersTable;
    private $authentication;
    private $images;
    private $get;
    private $post;

    public function __construct(DatabaseTable $carsTable, DatabaseTable $manufacturersTable, Authentication $authentication, Images $images, array $get, array $post)
    {
        $this->carsTable = $carsTable;
        $this->manufacturersTable = $manufacturersTable;
        $this->authentication = $authentication;
        $this->images = $images;
        $this->get = $get;
        $this->post = $post;
    }

    public function cars()
    {
        $cars = $this->carsTable->find('archived', 'false');

        return [
            'template' => 'admin/cars.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'cars' => $cars
            ]
        ];
    }

    public function archivedCars()
    {
        $cars = $this->carsTable->find('archived', 'true');

        return [
            'template' => 'admin/cars.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'cars' => $cars
            ]
        ];
    }

    public function showroom()
    {
//        FIXME archived cars show on the page when they are filtered by manufacturer, also if all cars from specific manufacturer are archived option to filter is still present
        if (isset($this->get['id'])) {
            $cars2 = $this->carsTable->find('manufacturer_id', $this->get['id']);
            $cars = [];
            foreach ($cars2 as $key => $car) {
                if ($car->archived == 'false') {
                    $cars[] = $car;
                }
            }
        } else {
            $cars = $this->carsTable->find('archived', 'false');
        }

        $manufacturers2 = $this->manufacturersTable->findAll();
        $manufacturers = [];

        foreach ($manufacturers2 as $manufacturer) {
            if ($manufacturer->countCars() != 0) {
                $manufacturers[] = $manufacturer;
            }
        }

        return [
            'template' => 'page/showroom.html.php',
            'title' => 'Our Cars',
            'variables' => [
                'cars' => $cars,
                'manufacturers' => $manufacturers
            ]
        ];
    }

    public function modifyCar($errors = [])
    {
        if (isset($this->get['id'])) {
            $car = $this->carsTable->find('id', $this->get['id'])[0];
        }
        $manufacturers = $this->manufacturersTable->findAll();

        return [
            'template' => 'admin/modifycar.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => (isset($this->get['id'])) ? 'Edit' : 'Add',
                'car' => $car ?? '',
                'manufacturers' => $manufacturers,
                'errors' => $errors
            ]
        ];
    }

    public function validateCar($car)
    {
        $errors = [];

        if (empty($car['name'])) {
            $errors[] = 'Model name cannot be empty';
        }
        if (empty($car['price'])) {
            $errors[] = 'Price cannot be empty';
        }
        if (empty($car['description'])) {
            $errors[] = 'Description cannot be empty';
        }
        if (empty($car['mileage'])) {
            $errors[] = 'Mileage cannot be empty';
        }
        if (empty($car['production_year'])) {
            $errors[] = 'Production year cannot be empty';
        }

        return $errors;
    }

    public function saveCar()
    {
        if (isset($this->get['id'])) {
            // Earlier price inserted only if it is higher than the current price
            $this->post['car']['earlier_price'] = $this->carsTable->find('id', $this->post['car']['id'])[0]->price;

            if ($this->post['car']['earlier_price'] <= $this->post['car']['price']) {
                $this->post['car']['earlier_price'] = NULL;
            }
        }

        $errors = $this->validateCar($this->post['car']);

        if (count($errors) == 0) {
            $this->post['car']['admin_id'] = $this->authentication->getUser()->id;
            $entity = $this->carsTable->save($this->post['car']);
            $this->images->uploadImage('cars', $entity->id);
            header('Location: cars');
            exit();
        }


        return $this->modifyCar($errors);
    }

    public function deleteCar()
    {
        return [
            'template' => 'admin/delete.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => 'car',
                'id' => $this->get['id']
            ]
        ];
    }

    public function processDelete()
    {
        $this->carsTable->delete('id', $this->get['id']);
        header('Location: cars');
    }

    //    Ask Tom if there is a way to remove number keys from array - can be fixed by using PDO::FETCH_COLUMN
    public function archive()
    {
        $car = $this->carsTable->find('id', $this->get['id'])[0];
        $record = [];
        $record['id'] = $car->id;
        if ($car->archived == 'false') {
            $record['archived'] = 'true';
            header("Location: cars");
        } else {
            $record['archived'] = 'false';
            header("Location: archivedcars");
        }

        $this->carsTable->save($record);
        exit();
    }
}