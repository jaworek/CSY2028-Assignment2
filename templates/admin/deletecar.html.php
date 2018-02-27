<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <p>Confirm deletion of the car:</p>
    <form method="post">
        <input type="hidden" name="id" value="<?= $car ?>">
        <input type="submit" name="submit" value="Delete">
    </form>
</section>