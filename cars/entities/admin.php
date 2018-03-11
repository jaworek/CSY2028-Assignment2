<?php

namespace Cars\Entities;

class Admin
{
    public $id;
    public $email;
    public $name;
    public $password;
    public $permissions;

    const SHOW_MANUFACTURERS = 1;
    const ADD_MANUFACTURER = 2;
    const EDIT_MANUFACTURER = 4;
    const DELETE_MANUFACTURER = 8;
    const SHOW_CARS = 16;
    const ADD_CAR = 32;
    const EDIT_CAR = 64;
    const DELETE_CAR = 128;
    const ARCHIVE_CAR = 256;
    const SHOW_INQUIRES = 512;
    const COMPLETE_INQUIRY = 1024;
    const SHOW_STAFF = 2048;
    const ADD_STAFF = 4096;
    const EDIT_STAFF = 8192;
    const DELETE_STAFF = 16384;
    const SHOW_NEWS = 32768;
    const ADD_NEWS = 65536;
    const EDIT_NEWS = 131072;
    const DELETE_NEWS = 262144;

    public function __construct()
    {

    }

    public function hasPermission($permission)
    {
        return $this->permissions & $permission;
    }
}