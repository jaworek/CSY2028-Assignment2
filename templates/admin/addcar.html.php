<?php
$pdo = new PDO('mysql:dbname=cars;host=127.0.0.1', 'student', 'student');
require 'sidepanel.html.php';
?>

<section class="right">
    <?php
    if (isset($_POST['submit'])) {

        $stmt = $pdo->prepare('INSERT INTO cars (name, description, price, manufacturerId) 
							   VALUES (:model, :description, :price, :manufacturerId)');

        $criteria = [
            'model' => $_POST['model'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'manufacturerId' => $_POST['manufacturerId']
        ];

        $stmt->execute($criteria);

        uploadImage();

        echo 'Car added';
    } else {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            ?>
            <h2>Add Car</h2>

            <form action="addcar.html.php" method="POST" enctype="multipart/form-data">
                <label>Car Model</label>
                <input type="text" name="model"/>

                <label>Description</label>
                <textarea name="description"></textarea>

                <label>Price</label>
                <input type="text" name="price"/>

                <label>Category</label>

                <select name="manufacturerId">
                    <?php
                    $stmt = $pdo->prepare('SELECT * FROM manufacturers');
                    $stmt->execute();

                    foreach ($stmt as $row) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }

                    ?>

                </select>

                <label>Image</label>

                <input type="file" name="image"/>

                <input type="submit" name="submit" value="Add Car"/>

            </form>


            <?php
        } else {
            ?>
            <h2>Log in</h2>

            <form action="index.php" method="post">

                <label>Password</label>
                <input type="password" name="password"/>

                <input type="submit" name="submit" value="Log In"/>
            </form>
            <?php
        }

    }
    ?>

</section>