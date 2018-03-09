<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2><?= $title ?> Manufacturer</h2>

    <?php if ($error) { ?>
        <p class="error">Name cannot be empty</p>
    <?php } ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $manufacturer->id ?? '' ?>"/>

        <label>Name</label>
        <input type="text" name="name" value="<?= $manufacturer->name ?? '' ?>"/>

        <input type="submit" name="submit" value="Save Manufacturer"/>
    </form>
</section>