<?php

namespace Cars\Controllers;

use Classes\Authentication;
use Classes\DatabaseTable;

class Inquires
{
    private $inquiresTable;
    private $authentication;

    public function __construct(DatabaseTable $inquiresTable, Authentication $authentication)
    {
        $this->inquiresTable = $inquiresTable;
        $this->authentication = $authentication;
    }

    public function inquires()
    {
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
        $author = $this->authentication->getUser();

        $inquiry = [];
        $inquiry['id'] = $_GET['id'];
        $inquiry['admin_id'] = $author['id'];
        $inquiry['complete'] = 'true';

        $this->inquiresTable->save($inquiry);

        header('Location: inquires');
        exit();
    }
}
