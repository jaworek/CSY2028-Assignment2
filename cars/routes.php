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
    public function callControllerFunction($route)
    {
        require '../database.php';

        // tables
        $carsTable = new DatabaseTable($pdo, 'cars', 'id');
        $manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id');
        $inquiresTable = new DatabaseTable($pdo, 'inquiries', 'id');
        $adminsTable = new DatabaseTable($pdo, 'admins', 'id');
        $newsTable = new DatabaseTable($pdo, 'news', 'id');

        // controllers
        $pageController = new Page($inquiresTable, $newsTable);
        $imagesController = new Images($pdo);
        $adminController = new Admin($adminsTable);
        $manufacturersController = new AdminManufacturers($manufacturersTable);
        $carsController = new AdminCars($carsTable, $manufacturersTable, $imagesController);
        $staffController = new AdminStaff($adminsTable);
        $newsController = new AdminNews($newsTable);
        $inquiresController = new AdminInquires($inquiresTable);

        // router
        if (empty($route)) {
            $page = $pageController->home();
        } else if ($route == 'cars/showroom') {
            $page = $carsController->showroom($_GET['id'] ?? '');
        } else if ($route == 'page/about') {
            $page = $pageController->about();
        } else if ($route == 'page/contact') {
            $page = $pageController->contact();
        } else if ($route == 'page/careers') {
            $page = $pageController->careers();
        } else if ($route == 'admin/admin') {
            $page = $adminController->admin();
        } else if ($route == 'admin/logout') {
            $adminController->logout();
        } else if ($route == 'admin/cars') {
            $page = $carsController->cars();
        } else if ($route == 'admin/archivedcars') {
            $page = $carsController->archivedCars();
        } else if ($route == 'admin/manufacturers') {
            $page = $manufacturersController->manufacturers();
        } else if ($route == 'admin/inquires') {
            $page = $inquiresController->inquires();
        } else if ($route == 'admin/archive') {
            $carsController->archive();
        } else if ($route == 'admin/addcar') {
            $page = $carsController->modifyCar();
        } else if ($route == 'admin/addmanufacturer') {
            $page = $manufacturersController->modifyManufacturer();
        } else if ($route == 'admin/editcar') {
            $page = $carsController->modifyCar();
        } else if ($route == 'admin/editmanufacturer') {
            $page = $manufacturersController->modifyManufacturer();
        } else if ($route == 'admin/deletecar') {
            $page = $carsController->deleteCar();
        } else if ($route == 'admin/deletemanufacturer') {
            $page = $manufacturersController->deleteManufacturer();
        } else if ($route == 'admin/staff') {
            $page = $staffController->staff();
        } else if ($route == 'admin/addstaff') {
            $page = $staffController->addStaff();
        } else if ($route == 'admin/addnews') {
            $page = $newsController->addNews();
        } else if ($route == 'admin/complete') {
            $page = $inquiresController->complete();
        } else if ($route == 'images/loadbanner') {
            $imagesController->loadBanner();
        } else {
            $page = $pageController->home();
        }

        return $page;
    }
}