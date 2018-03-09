<?php

namespace Cars\Controllers;

use Classes\DatabaseTable;
use Classes\Images;

class Cars
{
    private $carsTable;
    private $manufacturersTable;
    private $images;

    public function __construct(DatabaseTable $carsTable, DatabaseTable $manufacturersTable, Images $images)
    {
        $this->carsTable = $carsTable;
        $this->manufacturersTable = $manufacturersTable;
        $this->images = $images;
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
        if (isset($_GET['id'])) {
            $cars = $this->carsTable->find('manufacturer_id', $_GET['id']);
        } else {
            $cars = $this->carsTable->find('archived', 'false');
        }

        $allManufacturers = $this->manufacturersTable->findAll();
        $manufacturers = [];

        foreach ($allManufacturers as $manufacturer) {
            $count = $this->carsTable->count('manufacturer_id', $manufacturer['id']);
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

    public function modifyCar()
    {
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

    public function saveCar()
    {
        if (isset($_GET['id'])) {
            // Earlier price inserted only if it is higher than the current price
            $_POST['car']['earlier_price'] = $this->carsTable->find('id', $_POST['car']['id'])[0]['price'];

            if ($_POST['car']['earlier_price'] <= $_POST['car']['price']) {
                $_POST['car']['earlier_price'] = NULL;
            }
        }

        $_POST['car']['admin_id'] = $_SESSION['id'];
        $this->carsTable->save($_POST['car']);
        $this->images->uploadImage('cars');

        header('Location: cars');
    }

    public function deleteCar()
    {
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

    public function processDelete()
    {
        $this->carsTable->delete('id', $_GET['id']);
        header('Location: cars');
    }

    //    Ask Tom if there is a way to remove number keys from array - can be fixed by using PDO::FETCH_COLUMN
    public function archive()
    {
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

        $this->carsTable->save($record);
        exit();
    }
}