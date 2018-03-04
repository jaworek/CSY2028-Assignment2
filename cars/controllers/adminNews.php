<?php

namespace Cars\Controllers;

class AdminNews
{
    private $newsTable;

    public function __construct($newsTable)
    {
        $this->newsTable = $newsTable;
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
    }

    public function addNews()
    {
        $this->isLogged();

        if (isset($_POST['submit'])) {
            $this->newsTable->save($_POST['news']);
        }

        return [
            'template' => 'admin/addnews.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => []
        ];
    }

    public function editNews()
    {

    }

    public function deleteNews()
    {

    }
}