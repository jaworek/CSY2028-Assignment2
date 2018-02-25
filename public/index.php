<?php
session_start();
require '../functions/functions.php';
require '../functions/connectDb.php';
require '../classes/databasetable.php';
require '../classes/pagecontroller.php';
require '../classes/admincontroller.php';
require '../classes/carcontroller.php';

// database connection
$pdo = connectDatabase();

// tables
$carsTable = new DatabaseTable($pdo, 'cars', 'id');
$manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id');

// controllers
$pageController = new PageController();
$adminController = new AdminController();
$carController = new CarController($carsTable, $manufacturersTable);

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
} else {
    $page = $pageController->home();
}

$output = loadTemplate('../templates/' . $page['template'], $page['variables']);
$title = $page['title'];
$class = $page['class'] ?? 'home';

require '../templates/layout.html.php';
