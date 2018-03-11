<?php

namespace Cars\Controllers;

use Classes\DatabaseTable;

class Page
{
    private $inquiresTable;
    private $newsTable;
    private $adminsTable;

    public function __construct(DatabaseTable $inquiresTable, DatabaseTable $newsTable, DatabaseTable $adminsTable)
    {
        $this->inquiresTable = $inquiresTable;
        $this->newsTable = $newsTable;
        $this->adminsTable = $adminsTable;
    }

    public function home()
    {
        $news = $this->newsTable->findAll();

        return [
            'template' => 'page/home.html.php',
            'title' => 'Home',
            'variables' => [
                'news' => $news,
            ]
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

    public function contact($error = [], $message = false)
    {
        return [
            'template' => 'page/contact.html.php',
            'title' => 'Contact us',
            'variables' => [
                'error' => $error,
                'message' => $message
            ]
        ];
    }

    public function sendInquiry()
    {
        $contact = $_POST['contact'];
        $error = [];
        $message = false;

        if (empty($contact['name'])) {
            $error['name'] = true;
        } else if (empty($contact['email'])) {
            $error['empty_email'] = true;
        } else if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
            $error['wrong_email'] = true;
        } else if (empty($contact['telephone'])) {
            $error['telephone'] = true;
        } else if (empty($contact['message'])) {
            $error['message'] = true;
        } else {
            $message = true;
            $this->inquiresTable->save($_POST['contact']);
        }

        return $this->contact($error, $message);
    }

    public function careers()
    {
        return [
            'template' => 'page/careers.html.php',
            'title' => 'Claire’s Careers',
            'variables' => []
        ];
    }

    public function news()
    {
        $news = $this->newsTable->find('id', $_GET['id'])[0];

        return [
            'template' => 'page/news.html.php',
            'title' => 'Claire’s Careers',
            'variables' => [
                'news' => $news,
            ]
        ];
    }
}
