<?php
session_start();
require '../autoload.php';
$routes = new \Cars\Routes();
$entryPoint = new \Classes\EntryPoint($routes);
$entryPoint->run();