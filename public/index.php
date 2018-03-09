<?php
require '../autoload.php';
$routes = new \Cars\Routes();
$entryPoint = new \Classes\EntryPoint($routes);
$entryPoint->run();