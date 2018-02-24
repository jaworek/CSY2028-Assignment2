<?php
require '../functions/connectDb.php';
require '../functions/loadtemplate.php';
require '../classes/databasetable.php';
require '../classes/pagecontroller.php';

// database connection
$pdo = connectDatabase();

// tables
$carsTable = new DatabaseTable($pdo, 'cars', 'id');
$manufacturersTable = new DatabaseTable($pdo, 'manufacturers', 'id');

// controllers
$pageController = new PageController();

$route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
if (empty($route)) {
    $page = $pageController->home();
} else if ($route == 'page/cars') {
    $page = $pageController->cars();
} else if ($route == 'page/about') {
    $page = $pageController->about();
} else if ($route == 'page/contact') {
    $page = $pageController->contact();
} else {
    $page = $pageController->home();
}

$output = loadTemplate('../templates/' . $page['template'], $page['variables']);
$title = $page['title'];

require '../templates/layout.html.php';
