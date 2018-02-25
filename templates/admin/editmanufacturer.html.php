<?php
$pdo = new PDO('mysql:dbname=cars;host=127.0.0.1', 'student', 'student');
require 'sidepanel.html.php';
?>

<section class="right">
    <?php
    if (isset($_POST['submit'])) {

        $stmt = $pdo->prepare('UPDATE manufacturers SET name = :name WHERE id = :id ');

        $criteria = [
            'name' => $_POST['name'],
            'id' => $_POST['id']
        ];

        $stmt->execute($criteria);
        echo 'Manufacturer Saved';
    } else {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            $currentMan = $pdo->query('SELECT * FROM manufacturers WHERE id = ' . $_GET['id'])->fetch();
            ?>


            <h2>Edit Manufacturer</h2>

            <form action="" method="POST">

                <input type="hidden" name="id" value="<?php echo $currentMan['id']; ?>"/>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $currentMan['name']; ?>"/>


                <input type="submit" name="submit" value="Save Manufacturer"/>

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