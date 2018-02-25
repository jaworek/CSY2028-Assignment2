<?php
$pdo = new PDO('mysql:dbname=cars;host=127.0.0.1', 'student', 'student');
require 'sidepanel.html.php';
?>

<section class="right">
    <?php
    if (isset($_POST['submit'])) {

        $stmt = $pdo->prepare('INSERT INTO manufacturers (name) VALUES (:name)');

        $criteria = [
            'name' => $_POST['name']
        ];

        $stmt->execute($criteria);
        echo 'Manufacturer added';
    } else {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            ?>


            <h2>Add Manufacturer</h2>

            <form action="" method="POST">
                <label>Name</label>
                <input type="text" name="name"/>


                <input type="submit" name="submit" value="Add Manufacturer"/>

            </form>


            <?php
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

    }
    ?>
</section>