<?php

namespace Cars\Controllers;

class AdminNews
{
    private $newsTable;
    private $adminsTable;
    private $imagesController;

    public function __construct($newsTable, $adminsTable, $imagesController)
    {
        $this->newsTable = $newsTable;
        $this->adminsTable = $adminsTable;
        $this->imagesController = $imagesController;
    }

    private function isLogged()
    {
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
            header("Location: /admin/admin");
            exit();
        }
    }

    public function news()
    {
        $this->isLogged();

        $news = $this->newsTable->findAll();

        foreach ($news as $key => $element) {
            $element['author_name'] = $this->adminsTable->find('id', $element['admin_id'])[0]['name'];
            $news[$key] = $element;
        }

        return [
            'template' => 'admin/news.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'news' => $news
            ]
        ];
    }

    public function addNews()
    {
        $this->isLogged();

        return [
            'template' => 'admin/addnews.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    public function saveNews()
    {
        $_POST['news']['admin_id'] = $_SESSION['id'];

        $this->newsTable->save($_POST['news']);
        $this->imagesController->uploadImage('news');

        header('Location: news');
    }

    public function editNews()
    {
        $this->isLogged();


    }

    public function deleteNews()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {
            $this->newsTable->delete('id', $_GET['id']);
            header('Location: news');
        }
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
}