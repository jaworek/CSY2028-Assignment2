<?php
function loadTemplate($fileName, $templateVars = [])
{
    extract($templateVars);
    ob_start();
    require $fileName;
    $contents = ob_get_clean();
    return $contents;
}

function uploadImage() {
    $pdo = new PDO('mysql:dbname=cars;host=127.0.0.1', 'student', 'student');
    if ($_FILES['image']['error'] == 0) {
        $fileName = $pdo->lastInsertId() . '.jpg';
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/cars/' . $fileName);
    }
}
