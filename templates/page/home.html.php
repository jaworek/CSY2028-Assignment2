<p>Welcome to Claire's Cars, Northampton's specialist in classic and import cars.</p>

<ul class="cars">
    <?php foreach ($news as $element) { ?>
        <li>
            <div class="details">
                <h2>
                    <a href="/page/news?id=<?= $element['id'] ?>"><?= $element['title'] ?></a>
                </h2>
                <h3>Posted by: <?= $element['author_name'] ?></h3>
                <h3>Date: <?= $element['date'] ?></h3>
            </div>
        </li>
    <?php } ?>
</ul>