<?php

namespace Cars\Controllers;

use Classes\Authentication;
use Classes\DatabaseTable;

class Inquires
{
    private $inquiresTable;
    private $authentication;
    private $get;

    public function __construct(DatabaseTable $inquiresTable, Authentication $authentication, $get)
    {
        $this->inquiresTable = $inquiresTable;
        $this->authentication = $authentication;
        $this->get = $get;
    }

    public function inquires()
    {
        $inquires = $this->inquiresTable->find('complete', 'false');

        return [
            'template' => 'admin/inquires.html.php',
            'title' => 'Admin',
            'class' => 'admin',
            'variables' => [
                'inquires' => $inquires
            ]
        ];
    }

    public function completeInquires()
    {
        $inquires = $this->inquiresTable->find('complete', 'true');

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
        $inquiry['id'] = $this->get['id'];
        $inquiry['admin_id'] = $author->id;
        $inquiry['complete'] = 'true';

        $this->inquiresTable->save($inquiry);

        header('Location: inquires');
        exit();
    }
}
