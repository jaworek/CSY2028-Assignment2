<?php

namespace Cars\Controllers;

class AdminCars
{
    private $carsTable;
    private $manufacturersTable;
    private $imagesController;

    public function __construct($carsTable, $manufacturersTable, $imagesController)
    {
        $this->carsTable = $carsTable;
        $this->manufacturersTable = $manufacturersTable;
        $this->imagesController = $imagesController;
    }

    private function isLogged()
    {
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
            header("Location: /admin/admin");
            exit();
        }
    }

    public function cars()
    {
        $this->isLogged();
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
        $this->isLogged();
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

    public function showroom($manufacturerId)
    {
        if (empty($manufacturerId)) {
            $cars = $this->carsTable->find('archived', 'false');
        } else {
            $cars = $this->carsTable->find('manufacturerId', $manufacturerId);
        }

        $allManufacturers = $this->manufacturersTable->findAll();
        $manufacturers = [];

        foreach ($allManufacturers as $manufacturer) {
            $count = $this->carsTable->count('manufacturerId', $manufacturer['id']);
            if ($count != 0) {
                array_push($manufacturers, $manufacturer);
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

    public function addCar()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {
            $this->carsTable->save($_POST['car']);
            $this->imagesController->uploadImage();
        }

        $manufacturers = $this->manufacturersTable->findAll();

        return [
            'template' => 'admin/modifycar.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => 'Add',
                'manufacturers' => $manufacturers
            ]
        ];
    }

    public function editCar()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {
            // Earlier price inserted only if it is higher than the current price
            $_POST['car']['earlier_price'] = $this->carsTable->find('id', $_POST['car']['id'])[0]['price'];

            if ($_POST['car']['earlier_price'] <= $_POST['car']['price']) {
                $_POST['car']['earlier_price'] = NULL;
            }

            $this->carsTable->save($_POST['car']);
            $this->imagesController->uploadImage();
        }

        $car = $this->carsTable->find('id', $_GET['id'])[0];
        $manufacturers = $this->manufacturersTable->findAll();

        return [
            'template' => 'admin/modifycar.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => 'Edit',
                'car' => $car,
                'manufacturers' => $manufacturers
            ]
        ];
    }

    public function modifyCar()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {
            if (isset($_GET['id'])) {
                // Earlier price inserted only if it is higher than the current price
                $_POST['car']['earlier_price'] = $this->carsTable->find('id', $_POST['car']['id'])[0]['price'];

                if ($_POST['car']['earlier_price'] <= $_POST['car']['price']) {
                    $_POST['car']['earlier_price'] = NULL;
                }
            }

            $this->carsTable->save($_POST['car']);
            $this->imagesController->uploadImage();
        }

        if (isset($_GET['id'])) {
            $car = $this->carsTable->find('id', $_GET['id'])[0];
        }
        $manufacturers = $this->manufacturersTable->findAll();

        return [
            'template' => 'admin/modifycar.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => (isset($_GET['id'])) ? 'Edit' : 'Add',
                'car' => $car ?? '',
                'manufacturers' => $manufacturers
            ]
        ];
    }

    public function deleteCar()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {
            $this->carsTable->delete('id', $_GET['id']);
            header('Location: cars');
        }

        return [
            'template' => 'admin/delete.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => 'car',
                'id' => $_GET['id']
            ]
        ];
    }

    //    Ask Tom if there is a way to remove number keys from array
    public function archive()
    {
        $this->isLogged();
        $car = $this->carsTable->find('id', $_GET['id'])[0];
        $record = [];
        $record['id'] = $car['id'];
        if ($car['archived'] == 'false') {
            $record['archived'] = 'true';
            header("Location: cars");
        } else {
            $record['archived'] = 'false';
            header("Location: archivedcars");
        }

        $this->carsTable->update($record);
        exit();
    }
}