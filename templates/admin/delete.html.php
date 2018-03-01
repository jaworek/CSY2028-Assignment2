<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <p>Confirm deletion of the <?= $title ?>:</p>
    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="submit" name="submit" value="Delete">
    </form>
</section>