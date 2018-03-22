<?php

namespace Cars\Controllers;

use Classes\Authentication;
use Classes\DatabaseTable;
use Classes\Images;

class News
{
    private $newsTable;
    private $adminsTable;
    private $authentication;
    private $images;

    public function __construct(DatabaseTable $newsTable, DatabaseTable $adminsTable, Authentication $authentication, Images $images)
    {
        $this->newsTable = $newsTable;
        $this->adminsTable = $adminsTable;
        $this->authentication = $authentication;
        $this->images = $images;
    }

    public function news()
    {
        $news = $this->newsTable->findAll();

        return [
            'template' => 'admin/news.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'news' => $news
            ]
        ];
    }

    public function addNews($errors = [])
    {
        return [
            'template' => 'admin/addnews.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'errors' => $errors
            ]
        ];
    }

    public function validateNews($news)
    {
        $errors = [];

        if (empty($news['title'])) {
            $errors[] = 'Title cannot be empty';
        }
        if (empty($news['content'])) {
            $errors[] = 'Content cannot be empty';
        }

        $exists = $this->newsTable->find('title', $news['title']);

        if (count($exists) > 0) {
            $errors[] = 'This title is already in use';
        }

        return $errors;
    }

    public function saveNews()
    {
        $errors = $this->validateNews($_POST['news']);

        if (count($errors) > 0) {
            return $this->addNews($errors);
        }

        $_POST['news']['admin_id'] = $this->authentication->getUser()->id;

        $entity = $this->newsTable->save($_POST['news']);
        $this->images->uploadImage('news', $entity->id);

        header('Location: news');
    }

    public function editNews()
    {

    }

    public function deleteNews()
    {
        return [
            'template' => 'admin/delete.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'title' => 'news',
                'id' => $_GET['id']
            ]
        ];
    }

    public function processDelete()
    {
        $this->newsTable->delete('id', $_GET['id']);
        header('Location: news');
    }
}