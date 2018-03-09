<?php

namespace Cars\Entities;

use Classes\DatabaseTable;

class News
{
    public $id;
    public $title;
    public $content;
    public $date;
    public $adminId;
    private $adminsTable;

    public function __construct(DatabaseTable $adminsTable)
    {
        $this->adminsTable = $adminsTable;
    }

    public function getAuthor()
    {
        return $this->adminsTable->find('id', $this->adminId);
    }
}