<?php
session_start();
require '../autoload.php';
$routes = new \Test\Routes();
$entryPoint = new \Classes\EntryPoint($routes);
$entryPoint->run();