<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2><?= $title ?> Manufacturer</h2>

    <?php if (count($errors) > 0) { ?>
        <p class="error">Manufacturer could not be added:</p>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?= $error ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $manufacturer->id ?? '' ?>"/>

        <label>Name</label>
        <input type="text" name="name" value="<?= $manufacturer->name ?? '' ?>"/>

        <input type="submit" name="submit" value="Save Manufacturer"/>
    </form>
</section>