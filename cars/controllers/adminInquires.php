<?php

namespace Cars\Controllers;

class AdminInquires
{
    private $inquiresTable;

    public function __construct($inquiresTable)
    {
        $this->inquiresTable = $inquiresTable;
    }

    private function isLogged()
    {
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
            header("Location: /admin/admin");
            exit();
        }
    }

    public function inquires()
    {
        $this->isLogged();

        $inquires = $this->inquiresTable->findAll();

        return [
            'template' => 'admin/inquires.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'inquires' => $inquires
            ]
        ];
    }

    public function complete()
    {
        $this->isLogged();

//        $inquiry = $this->inquiresTable->find('id', $_GET['id'])[0];

        $inquiry = [];
        $inquiry['id'] = $_GET['id'];
        $inquiry['admin_id'] = $_SESSION['id'];
        $inquiry['complete'] = 'true';

        $this->inquiresTable->update($inquiry);

        header('Location: inquires');
        exit();
    }
}
