<?php

namespace Cars;

use Cars\Controllers\Banner;
use Cars\Controllers\Inquires;
use Cars\Entities\Admin as AdminEntity;
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

        $this->adminsTable = new DatabaseTable($pdo, 'admins', 'id', '\Cars\Entities\Admin');
        $this->manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id', '\Cars\Entities\Manufacturer', [&$this->carsTable]);
        $this->inquiresTable = new DatabaseTable($pdo, 'inquiries', 'id', '\Cars\Entities\Inquiry', [&$this->adminsTable]);
        $this->newsTable = new DatabaseTable($pdo, 'news', 'id', '\Cars\Entities\News', [&$this->adminsTable]);
        $this->carsTable = new DatabaseTable($pdo, 'cars', 'id', '\Cars\Entities\Car', [&$this->adminsTable, &$this->manufacturersTable]);

        $this->authentication = new Authentication($this->adminsTable, 'email', 'password');
        $this->images = new Images();
    }

    public function getAuthentication(): Authentication
    {
        return $this->authentication;
    }

    public function checkPermission($permission): bool
    {
        $user = $this->authentication->getUser();

        if ($user && $user->hasPermission($permission)) {
            return true;
        }

        return false;
    }

    public function getRoutes(): array
    {
        // controllers
        $pageController = new Page($this->inquiresTable, $this->newsTable, $this->adminsTable);
        $adminController = new Admin($this->authentication);
        $manufacturersController = new Manufacturers($this->manufacturersTable);
        $carsController = new Cars($this->carsTable, $this->manufacturersTable, $this->authentication, $this->images);
        $staffController = new Staff($this->adminsTable);
        $newsController = new News($this->newsTable, $this->adminsTable, $this->authentication, $this->images);
        $inquiresController = new Inquires($this->inquiresTable, $this->authentication);
        $bannerController = new Banner();

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
                'login' => true,
                'permissions' => AdminEntity::SHOW_CARS
            ],
            'admin/archivedcars' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'archivedCars'
                ],
                'login' => true,
                'permissions' => AdminEntity::SHOW_CARS
            ],
            'admin/manufacturers' => [
                'GET' => [
                    'controller' => $manufacturersController,
                    'action' => 'manufacturers'
                ],
                'login' => true,
                'permissions' => AdminEntity::SHOW_MANUFACTURERS
            ],
            'admin/inquires' => [
                'GET' => [
                    'controller' => $inquiresController,
                    'action' => 'inquires'
                ],
                'login' => true,
                'permissions' => AdminEntity::SHOW_INQUIRES
            ],
            'admin/completeinquires' => [
                'GET' => [
                    'controller' => $inquiresController,
                    'action' => 'completeInquires'
                ],
                'login' => true,
                'permissions' => AdminEntity::SHOW_INQUIRES
            ],
            'admin/archive' => [
                'GET' => [
                    'controller' => $carsController,
                    'action' => 'archive'
                ],
                'login' => true,
                'permissions' => AdminEntity::ARCHIVE_CAR
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
                'login' => true,
                'permissions' => AdminEntity::ADD_CAR
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
                'login' => true,
                'permissions' => AdminEntity::ADD_MANUFACTURER
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
                'login' => true,
                'permissions' => AdminEntity::EDIT_CAR
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
                'login' => true,
                'permissions' => AdminEntity::EDIT_MANUFACTURER
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
                'login' => true,
                'permissions' => AdminEntity::DELETE_CAR
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
                'login' => true,
                'permissions' => AdminEntity::DELETE_MANUFACTURER
            ],
            'admin/staff' => [
                'GET' => [
                    'controller' => $staffController,
                    'action' => 'staff'
                ],
                'login' => true,
                'permissions' => AdminEntity::SHOW_STAFF
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
                'login' => true,
                'permissions' => AdminEntity::ADD_STAFF
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
                'login' => true,
                'permissions' => AdminEntity::DELETE_STAFF
            ],
            'admin/news' => [
                'GET' => [
                    'controller' => $newsController,
                    'action' => 'news'
                ],
                'login' => true,
                'permissions' => AdminEntity::SHOW_NEWS
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
                'login' => true,
                'permissions' => AdminEntity::ADD_NEWS
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
                'login' => true,
                'permissions' => AdminEntity::DELETE_NEWS
            ],
            'admin/complete' => [
                'GET' => [
                    'controller' => $inquiresController,
                    'action' => 'complete'
                ],
                'login' => true,
                'permissions' => AdminEntity::COMPLETE_INQUIRY
            ],
            'images/loadbanner' => [
                'GET' => [
                    'controller' => $bannerController,
                    'action' => 'loadBanner'
                ]
            ]
        ];

        return $routes;
    }
}