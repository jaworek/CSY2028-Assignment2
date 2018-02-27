<?php

namespace Test\Controllers;
class Page
{
    private $inquiresTable;

    public function __construct($inquiresTable)
    {
        $this->inquiresTable = $inquiresTable;
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
        if (isset($_POST['submit'])) {
            $record = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'telephone' => $_POST['telephone'],
                'message' => $_POST['message']
            ];

            $this->inquiresTable->insert($record);
        }

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
