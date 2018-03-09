<?php

namespace Cars;

use Cars\Controllers\Inquires;
use Classes\Authentication;
use Classes\DatabaseTable;
use Cars\Controllers\Cars;
use Cars\Controllers\Manufacturers;
use Cars\Controllers\News;
use Cars\Controllers\Staff;
use Cars\Controllers\Admin;
use Cars\Controllers\Page;
use Classes\Images;

class Routes implements \Classes\Routes
{
    private $carsTable;
    private $manufacturersTable;
    private $inquiresTable;
    private $adminsTable;
    private $newsTable;

    private $authentication;
    private $images;

    public function __construct()
    {
        require '../database.php';

        $this->carsTable = new DatabaseTable($pdo, 'cars', 'id');
        $this->manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id');
        $this->inquiresTable = new DatabaseTable($pdo, 'inquiries', 'id');
        $this->adminsTable = new DatabaseTable($pdo, 'admins', 'id');
        $this->newsTable = new DatabaseTable($pdo, 'news', 'id');

        $this->authentication = new Authentication($this->adminsTable, 'email', 'password');
        $this->images = new Images($pdo);
    }

    public function getAuthentication(): Authentication
    {
        return $this->authentication;
    }

    public function getRoutes(): array
    {
        // controllers
        $pageController = new Page($this->inquiresTable, $this->newsTable, $this->adminsTable);
        $adminController = new Admin($this->authentication);
        $manufacturersController = new Manufacturers($this->manufacturersTable);
        $carsController = new Cars($this->carsTable, $this->manufacturersTable, $this->images);
        $staffController = new Staff($this->adminsTable);
        $newsController = new News($this->newsTable, $this->adminsTable, $this->images);
        $inquiresController = new Inquires($this->inquiresTable, $this->authentication);

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
                ],
                'login' => true
            ],
            'admin/login' => [
                'GET' => [
                    'controller' => $adminController,
                    'action' => 'login'
                ],
                'POST' => [
                    'controller' => $adminController,
                    'action' => 'processLogin'
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
                    'action' => 'saveManufacturer'
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
                    'action' => 'saveManufacturer'
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
                    'action' => 'processDelete'
                ],
                'login' => true
            ],
            'admin/deletemanufacturer' => [
                'GET' => [
                    'controller' => $manufacturersController,
                    'action' => 'deleteManufacturer'
                ],
                'POST' => [
                    'controller' => $manufacturersController,
                    'action' => 'processDelete'
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
                    'action' => 'saveStaff'
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
                    'action' => 'processDelete'
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
                    'action' => 'processDelete'
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