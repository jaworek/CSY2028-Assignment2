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
    public $admin_id;

    private $adminsTable;
    private $admin;

    public function __construct(DatabaseTable $adminsTable)
    {
        $this->adminsTable = $adminsTable;
    }

    public function getAdmin()
    {
        if (empty($this->admin)) {
            $this->admin = $this->adminsTable->findById($this->admin_id);
        }

        return $this->admin;
    }
}