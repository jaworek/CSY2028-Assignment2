<?php

namespace Test;

use Classes\DatabaseTable;
use Test\Controllers\Admin;
use Test\Controllers\Car;
use Test\Controllers\Page;

class Routes
{
    public function callControllerAction()
    {
        require '../database.php';

        // tables
        $carsTable = new DatabaseTable($pdo, 'cars', 'id');
        $manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id');
        $inquiresTable = new DatabaseTable($pdo, 'inquiries', 'id');

        // controllers
        $pageController = new Page($inquiresTable);
        $adminController = new Admin($carsTable, $manufacturersTable);
        $carController = new Car($carsTable, $manufacturersTable);

        // router
        $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
        if (empty($route)) {
            $page = $pageController->home();
        } else if ($route == 'cars/showroom') {
            $page = $carController->showroom($_GET['id'] ?? '');
        } else if ($route == 'page/about') {
            $page = $pageController->about();
        } else if ($route == 'page/contact') {
            $page = $pageController->contact();
        } else if ($route == 'page/careers') {
            $page = $pageController->careers();
        } else if ($route == 'admin/admin') {
            $page = $adminController->admin();
        } else if ($route == 'admin/logout') {
            $page = $adminController->logout();
        } else if ($route == 'admin/cars') {
            $page = $adminController->cars();
        } else if ($route == 'admin/manufacturers') {
            $page = $adminController->manufacturers();
        } else if ($route == 'admin/inquires') {
            $page = $adminController->inquires();
        } else if ($route == 'admin/archive') {
            $page = $adminController->archive();
        } else if ($route == 'admin/addcar') {
            $page = $adminController->addCar();
        } else if ($route == 'admin/addmanufacturer') {
            $page = $adminController->addManufacturer();
        } else if ($route == 'admin/editcar') {
            $page = $adminController->editCar();
        } else if ($route == 'admin/editmanufacturer') {
            $page = $adminController->editManufacturer();
        } else if ($route == 'admin/deletecar') {
            $page = $adminController->deleteCar();
        } else if ($route == 'admin/deletemanufacturer') {
            $page = $adminController->deleteManufacturer();
        } else if ($route == 'admin/addstaff') {
            $page = $adminController->addStaff();
        } else if ($route == 'admin/addnews') {
            $page = $adminController->addNews();
        } else {
            $page = $pageController->home();
        }

        return $page;
    }
}