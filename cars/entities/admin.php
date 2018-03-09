<?php

namespace Cars\Entities;

use Classes\DatabaseTable;

class Admin
{
    public $id;
    public $email;
    public $name;
    public $password;
    private $adminsTable;

    public function __construct(DatabaseTable $adminsTable)
    {
        $this->adminsTable = $adminsTable;
    }

    public function getAdmin()
    {

    }

}