<?php

namespace Classes;

interface Routes
{
    public function getRoutes(): array;

    public function getAuthentication(): Authentication;
}