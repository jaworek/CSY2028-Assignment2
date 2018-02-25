<?php
function connectDatabase()
{
    $pdo = new PDO('mysql:dbname=cars; host=127.0.0.1', 'student', 'student');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $pdo;
}
