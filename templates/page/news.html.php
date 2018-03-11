<h2><?= $news->title ?></h2>

<p>Posted by: <?= $news->getAuthor()->name ?></p>

<?php if (file_exists("images/news/{$news->id}.jpg")) { ?>
    <a href="images/cars/<?= $news->id ?>.jpg"><img src="/images/news/<?= $news->id ?>.jpg"/></a>
<?php } ?>

<p><?= $news->content ?></p>