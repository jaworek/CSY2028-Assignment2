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
    private $newsTable;

    public function __construct(DatabaseTable $newsTable)
    {
        $this->newsTable = $newsTable;
    }

    public function getNews()
    {

    }
}