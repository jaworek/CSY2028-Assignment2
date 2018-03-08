<?php

namespace Cars\Controllers;
class Page
{
    private $inquiresTable;
    private $newsTable;
    private $adminsTable;

    public function __construct($inquiresTable, $newsTable, $adminsTable)
    {
        $this->inquiresTable = $inquiresTable;
        $this->newsTable = $newsTable;
        $this->adminsTable = $adminsTable;
    }

    public function home()
    {
        $news = $this->newsTable->findAll();

        foreach ($news as $key => $element) {
            $element['author_name'] = $this->adminsTable->find('id', $element['admin_id'])[0]['name'];
            $news[$key] = $element;
        }

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

        if ($contact['name'] == '') {
            $error['name'] = true;
        } elseif ($contact['email'] == '') {
            $error['email'] = true;
        } elseif ($contact['telephone'] == '') {
            $error['telephone'] = true;
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
        $news['author_name'] = $this->adminsTable->find('id', $news['admin_id'])[0]['name'];

        return [
            'template' => 'page/news.html.php',
            'title' => 'Claire’s Careers',
            'variables' => [
                'news' => $news,
            ]
        ];
    }
}
