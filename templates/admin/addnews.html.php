<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Add news article</h2>

    <?php if ($error) { ?>
        <p class="error">Error</p>
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