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
    private $inquiresTable;

    public function __construct(DatabaseTable $inquiresTable)
    {
        $this->inquiresTable = $inquiresTable;
    }

    public function getInquiry()
    {

    }

}