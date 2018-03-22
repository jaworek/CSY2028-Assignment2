<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Add news article</h2>

    <?php if (count($errors) > 0) { ?>
        <p class="error">News could not be added:</p>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?= $error ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Title</label>
        <input type="text" name="news[title]">

        <label>Content</label>
        <textarea name="news[content]"></textarea>

        <label>Image</label>
        <input type="file" name="image"/>

        <input type="submit" name="submit" value="Submit">
    </form>
</section>