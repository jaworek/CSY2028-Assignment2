<?php

namespace Classes;
class EntryPoint
{
    private $routes;

    public function __construct(Routes $routes)
    {
        $this->routes = $routes;
    }

    public function run()
    {
        $route = strtolower(ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/'));
        $method = $_SERVER['REQUEST_METHOD'];
        $routes = $this->routes->getRoutes();
        $controller = $routes[$route][$method]['controller'];
        $action = $routes[$route][$method]['action'];

        $page = $controller->$action();

        $output = $this->loadTemplate('../templates/' . $page['template'], $page['variables']);
        $title = $page['title'];
        $class = $page['class'] ?? 'home';

        require '../templates/layout.html.php';

    }

    public function loadTemplate($fileName, $templateVars = [])
    {
        extract($templateVars);
        ob_start();
        require $fileName;
        $contents = ob_get_clean();
        return $contents;
    }
}