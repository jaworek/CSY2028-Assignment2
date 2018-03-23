<?php

namespace Cars\Controllers;

use Classes\DatabaseTable;

class Page
{
    private $inquiresTable;
    private $newsTable;
    private $adminsTable;
    private $get;
    private $post;

    public function __construct(DatabaseTable $inquiresTable, DatabaseTable $newsTable, DatabaseTable $adminsTable, array $get, array $post)
    {
        $this->inquiresTable = $inquiresTable;
        $this->newsTable = $newsTable;
        $this->adminsTable = $adminsTable;
        $this->get = $get;
        $this->post = $post;
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

    public function contact($errors = [])
    {
        return [
            'template' => 'page/contact.html.php',
            'title' => 'Contact us',
            'variables' => [
                'errors' => $errors,
            ]
        ];
    }

    public function validateInquiry($inquiry)
    {
        $errors = [];

        if (empty($inquiry['name'])) {
            $errors[] = 'Name cannot be empty';
        }
        if (empty($inquiry['email'])) {
            $errors[] = 'Email cannot be empty';
        } else if (!filter_var($inquiry['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email is not valid';
        }
        if (empty($inquiry['telephone'])) {
            $errors[] = 'Telephone cannot be empty';
        }
        if (empty($inquiry['message'])) {
            $errors[] = 'Message cannot be empty';
        }

        return $errors;
    }

    public function sendInquiry()
    {
        $errors = $this->validateInquiry($this->post['contact']);

        if (count($errors) == 0) {
            $this->inquiresTable->save($this->post['contact']);
        }

        return $this->contact($errors);
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
        $news = $this->newsTable->find('id', $this->get['id'])[0];

        return [
            'template' => 'page/news.html.php',
            'title' => 'Claire’s Careers',
            'variables' => [
                'news' => $news,
            ]
        ];
    }
}
