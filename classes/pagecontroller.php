<?php

class PageController
{
    public function __construct()
    {

    }

    public function home()
    {
        return [
            'template' => 'home.html.php',
            'title' => 'Home',
            'variables' => []
        ];
    }

    public function cars()
    {
        return [
            'template' => 'cars.html.php',
            'title' => 'Our Cars',
            'variables' => []
        ];
    }

    public function about()
    {
        return [
            'template' => 'about.html.php',
            'title' => 'About us',
            'variables' => []
        ];
    }

    public function contact()
    {
        return [
            'template' => 'contact.html.php',
            'title' => 'Contact us',
            'variables' => []
        ];
    }
}
