<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>News</h2>

    <a href="/admin/addnews">Add news article</a>

    <?php foreach ($news as $element) { ?>
        <div>
            <p><?= $element->title ?> <a href="/admin/deletenews?id=<?= $element->id ?>">Delete</a></p>
        </div>
    <?php } ?>
</section>