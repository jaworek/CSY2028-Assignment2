<?php

namespace Cars\Entities;

use Classes\DatabaseTable;

class Inquiry
{
    public $id;
    public $message;
    public $email;
    public $name;
    public $telephone;
    public $adminId;
    private $adminsTable;

    public function __construct(DatabaseTable $adminsTable)
    {
        $this->adminsTable = $adminsTable;
    }

    public function getAdmin()
    {
        return $this->adminsTable->find('id', $this->adminId);
    }
}