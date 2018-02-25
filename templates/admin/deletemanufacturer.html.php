<?php
$pdo = new PDO('mysql:dbname=cars;host=127.0.0.1', 'student', 'student');
require 'sidepanel.html.php';
?>


<section class="right">

    <?php


    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

        $products = $pdo->query('DELETE FROM manufacturers WHERE id = ' . $_POST['id']);

        echo 'Manufacturer deleted';

    } else {
        ?>
        <h2>Log in</h2>

        <form action="index.php" method="post">
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