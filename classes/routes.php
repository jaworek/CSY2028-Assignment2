<?php

namespace Classes;

interface Routes
{
    public function getAuthentication(): Authentication;

    public function checkPermission($permission): bool;

    public function getRoutes(): array;
}