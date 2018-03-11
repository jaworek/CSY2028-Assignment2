<?php

namespace Cars\Entities;

use Classes\DatabaseTable;

class News
{
    public $id;
    public $title;
    public $content;
    public $date;
    public $admin_id;

    private $adminsTable;
    private $author;

    public function __construct(DatabaseTable $adminsTable)
    {
        $this->adminsTable = $adminsTable;
    }

    public function getAuthor()
    {
        if (empty($this->author)) {
            $this->author = $this->adminsTable->findById($this->admin_id);
        }
        return $this->author;
    }
}