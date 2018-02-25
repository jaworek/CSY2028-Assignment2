<?php

class PageController
{
    public function __construct()
    {

    }

    public function home()
    {
        return [
            'template' => 'page/home.html.php',
            'title' => 'Home',
            'variables' => []
        ];
    }

    public function about()
    {
        return [
            'template' => 'page/about.html.php',
            'title' => 'About us',
            'variables' => []
        ];
    }

    public function contact()
    {
        return [
            'template' => 'page/contact.html.php',
            'title' => 'Contact us',
            'variables' => []
        ];
    }

    public function careers()
    {
        return [
            'template' => 'page/careers.html.php',
            'title' => 'Claire’s Careers',
            'variables' => []
        ];
    }
}
