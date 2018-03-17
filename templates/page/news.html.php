<h2><?= $news->title ?></h2>

<p>Posted by: <?= $news->getAuthor()->name ?></p>

<?php if (file_exists("images/news/{$news->id}_1.jpg")) { ?>
    <a href="images/cars/<?= $news->id ?>.jpg"><img src="/images/news/<?= $news->id ?>_1.jpg"/></a>
<?php } ?>

<p><?= $news->content ?></p>