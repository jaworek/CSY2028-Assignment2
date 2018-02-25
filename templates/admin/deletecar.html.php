<?php
$pdo = new PDO('mysql:dbname=cars;host=127.0.0.1', 'student', 'student');
require 'sidepanel.html.php';
?>

<section class="right">

    <?php


    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

        $stmt = $pdo->prepare('DELETE FROM cars WHERE id = :id');
        $stmt->execute(['id' => $_POST['id']]);

        echo 'Car deleted';

    } else {
        ?>
        <h2>Log in</h2>

        <form method="post">
            <label>Username</label>
            <input type="text" name="username"/>

            <label>Password</label>
            <input type="password" name="password"/>

            <input type="submit" name="submit" value="Log In"/>
        </form>
        <?php
    }
    ?>
</section>