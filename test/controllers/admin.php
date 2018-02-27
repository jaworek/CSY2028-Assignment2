<?php

namespace Test\Controllers;
class Admin
{
    private $carsTable;
    private $manufacturersTable;

    public function __construct($carsTable, $manufacturersTable)
    {
        $this->carsTable = $carsTable;
        $this->manufacturersTable = $manufacturersTable;
    }

    public function admin()
    {
        if (isset($_POST['submit'])) {
            if ($_POST['password'] == 'opensesame') {
                $_SESSION['loggedin'] = true;
            }
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return $this->mainPanel();
        } else {
            return $this->login();
        }
    }

    private function mainPanel()
    {
        return [
            'template' => 'admin/admin.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    private function login()
    {
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

    public function cars()
    {
        $this->isLogged();
        $cars = $this->carsTable->findAll();

        return [
            'template' => 'admin/cars.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'cars' => $cars
            ]
        ];
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

    public function inquires()
    {
        $this->isLogged();

        return [
            'template' => 'admin/inquires.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
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
        } else {
            $record['archived'] = 'false';
        }

        $this->carsTable->update($record);
        header("Location: cars");
        exit();
    }

    private function isLogged()
    {
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
            header("Location: /admin/admin");
            exit();
        }
    }

    public function addCar()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {

            $record = [
                'name' => $_POST['model'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'manufacturerId' => $_POST['manufacturerId']
            ];

            $this->carsTable->insert($record);

//            uploadImage();
        }

        $manufacturers = $this->manufacturersTable->findAll();

        return [
            'template' => 'admin/addcar.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'manufacturers' => $manufacturers
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
            'template' => 'admin/addmanufacturer.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    public function editCar()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {
// Earlier price inserted only if it is higher than the current price
            $earlierPrice = $this->carsTable->find('id', $_POST['id'])[0]['price'];

            $record = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'earlier_price' => ($earlierPrice > $_POST['price']) ? $earlierPrice : NULL,
                'manufacturerId' => $_POST['manufacturerId'],
                'id' => $_POST['id']
            ];

            $this->carsTable->update($record);

            if ($_FILES['image']['error'] == 0) {
//                $fileName = $pdo->lastInsertId() . '.jpg';
//                move_uploaded_file($_FILES['image']['tmp_name'], '../productimages/' . $fileName);
            }
        }

        $car = $this->carsTable->find('id', $_GET['id'])[0];
        $manufacturers = $this->manufacturersTable->findAll();

        return [
            'template' => 'admin/editcar.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'car' => $car,
                'manufacturers' => $manufacturers
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
            'template' => 'admin/editmanufacturer.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'manufacturer' => $manufacturer
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
            'template' => 'admin/deletecar.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'car' => $_GET['id']
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
            'template' => 'admin/deletemanufacturer.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'manufacturer' => $_GET['id']
            ]
        ];
    }

    public function addStaff()
    {
        $this->isLogged();

        return [
            'template' => 'admin/addstaff.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    public function addNews()
    {
        $this->isLogged();

        return [
            'template' => 'admin/addnews.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }
}