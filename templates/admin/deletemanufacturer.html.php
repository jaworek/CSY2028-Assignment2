<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <p>Confirm deletion of the manufacturer:</p>
    <form method="post">
        <input type="hidden" name="id" value="<?= $manufacturer ?>">
        <input type="submit" name="submit" value="Delete">
    </form>
</section>