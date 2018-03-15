<?php

namespace Classes;

use PDO;

class Images {
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

//    pass name of the image as an argument
    public function uploadImage($path)
    {
        if ($_FILES['image']['error'] == 0) {
            $fileName = $this->pdo->lastInsertId() . '.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'], "images/$path/" . $fileName);
        }
    }

    public function uploadImage2($path, $fileName)
    {
        if ($_FILES['image']['error'] == 0) {
            $fileName = $fileName . '.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'], "images/$path/" . $fileName);
        }
    }
}