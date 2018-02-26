<?php

namespace Classes;
class EntryPoint
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function run()
    {
        $page = $this->routes->callControllerAction();

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