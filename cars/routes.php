<?php

namespace Cars;

use Cars\Controllers\AdminInquires;
use Classes\DatabaseTable;
use Cars\Controllers\AdminCars;
use Cars\Controllers\AdminManufacturers;
use Cars\Controllers\AdminNews;
use Cars\Controllers\AdminStaff;
use Cars\Controllers\Images;
use Cars\Controllers\Admin;
use Cars\Controllers\Page;

class Routes implements \Classes\Routes
{
    private $pdo;
    private $carsTable;
    private $manufacturersTable;
    private $inquiresTable;
    private $adminsTable;
    private $newsTable;

    public function __construct()
    {
        require '../database.php';

        $this->pdo = $pdo;
        $this->carsTable = new DatabaseTable($pdo, 'cars', 'id');
        $this->manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id');
        $this->inquiresTable = new DatabaseTable($pdo, 'inquiries', 'id');
        $this->adminsTable = new DatabaseTable($pdo, 'admins', 'id');
        $this->newsTable = new DatabaseTable($pdo, 'news', 'id');
    }

    public function getAuthentication()
    {

    }

    public function getRoutes()
    {
        // controllers
        $pageController = new Page($this->inquiresTable, $this->newsTable, $this->adminsTable);
        $imagesController = new Images($this->pdo);
        $adminController = new Admin($this->adminsTable);
        $manufacturersController = new AdminManufacturers($this->manufacturersTable);
        $carsController = new AdminCars($this->carsTable, $this->manufacturersTable, $imagesController);
        $staffController = new AdminStaff($this->adminsTable);
        $newsController = new AdminNews($this->newsTable, $this->adminsTable, $imagesController);
        $inquiresController = new AdminInquires($this->inquiresTable);

        $routes = [
            '' => [
                'GET' => [
                    'controller' => $pageController,
                    'action' => 'home'
                ]
            ],
            'cars/showroom' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'showroom'
                ]
            ],
            'page/about' => [
                'GET' => [
                    'controller' => $pageController,
                    'action' => 'about'
                ]
            ],
            'page/contact' => [
                'GET' => [
                    'controller' => $pageController,
                    'action' => 'contact'
                ],
                'POST' => [
                    'controller' => $pageController,
                    'action' => 'sendInquiry'
                ]
            ],
            'page/careers' => [
                'GET' => [
                    'controller' => $pageController,
                    'action' => 'careers'
                ]
            ],
            'page/news' => [
                'GET' => [
                    'controller' => $pageController,
                    'action' => 'news'
                ]
            ],
            'admin/admin' => [
                'GET' => [
                    'controller' => $adminController,
                    'action' => 'admin'
                ]
            ],
            'admin/login' => [
                'GET' => [
                    'controller' => $adminController,
                    'action' => 'login'
                ],
                'POST' => [
                    'controller' => $adminController,
                    'action' => 'checkCredentials'
                ]
            ],
            'admin/logout' => [
                'GET' => [
                    'controller' => $adminController,
                    'action' => 'logout'
                ],
                'login' => true
            ],
            'admin/cars' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'cars'
                ],
                'login' => true
            ],
            'admin/archivedcars' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'archivedCars'
                ],
                'login' => true
            ],
            'admin/manufacturers' => [
                'GET' => [
                    'controller' => $manufacturersController,
                    'action' => 'manufacturers'
                ],
                'login' => true
            ],
            'admin/inquires' => [
                'GET' => [
                    'controller' => $inquiresController,
                    'action' => 'inquires'
                ],
                'login' => true
            ],
            'admin/archive' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'archive'
                ],
                'login' => true
            ],
            'admin/addcar' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'modifyCar'
                ],
                'POST' => [
                    'controller' => $carsController,
                    'action' => 'saveCar'
                ],
                'login' => true
            ],
            'admin/addmanufacturer' => [
                'GET' => [
                    'controller' => $manufacturersController,
                    'action' => 'modifyManufacturer'
                ],
                'POST' => [
                    'controller' => $manufacturersController,
                    'action' => 'modifyManufacturer'
                ],
                'login' => true
            ],
            'admin/editcar' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'modifyCar'
                ],
                'POST' => [
                    'controller' => $carsController,
                    'action' => 'saveCar'
                ],
                'login' => true
            ],
            'admin/editmanufacturer' => [
                'GET' => [
                    'controller' => $manufacturersController,
                    'action' => 'modifyManufacturer'
                ],
                'POST' => [
                    'controller' => $manufacturersController,
                    'action' => 'modifyManufacturer'
                ],
                'login' => true
            ],
            'admin/deletecar' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'deleteCar'
                ],
                'POST' => [
                    'controller' => $carsController,
                    'action' => 'deleteCar'
                ],
                'login' => true
            ],
            'admin/deletemanufacturer' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'deleteManufacturer'
                ],
                'POST' => [
                    'controller' => $carsController,
                    'action' => 'deleteManufacturer'
                ],
                'login' => true
            ],
            'admin/staff' => [
                'GET' => [
                    'controller' => $staffController,
                    'action' => 'staff'
                ],
                'login' => true
            ],
            'admin/addstaff' => [
                'GET' => [
                    'controller' => $staffController,
                    'action' => 'addStaff'
                ],
                'POST' => [
                    'controller' => $staffController,
                    'action' => 'addStaff'
                ],
                'login' => true
            ],
            'admin/deletestaff' => [
                'GET' => [
                    'controller' => $staffController,
                    'action' => 'deleteStaff'
                ],
                'POST' => [
                    'controller' => $staffController,
                    'action' => 'deleteStaff'
                ],
                'login' => true
            ],
            'admin/news' => [
                'GET' => [
                    'controller' => $newsController,
                    'action' => 'news'
                ],
                'login' => true
            ],
            'admin/addnews' => [
                'GET' => [
                    'controller' => $newsController,
                    'action' => 'addNews'
                ],
                'POST' => [
                    'controller' => $newsController,
                    'action' => 'saveNews'
                ],
                'login' => true
            ],
            'admin/deletenews' => [
                'GET' => [
                    'controller' => $newsController,
                    'action' => 'deleteNews'
                ],
                'POST' => [
                    'controller' => $newsController,
                    'action' => 'deleteNews'
                ],
                'login' => true
            ],
            'admin/complete' => [
                'GET' => [
                    'controller' => $inquiresController,
                    'action' => 'complete'
                ],
                'login' => true
            ]
        ];

        return $routes;
    }
}