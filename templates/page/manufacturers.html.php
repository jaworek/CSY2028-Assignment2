<li><a href="/cars/showroom">All</a></li>
<?php foreach ($manufacturers as $manufacturer) { ?>
    <li><a href="/cars/showroom?id=<?= $manufacturer['id'] ?>"><?= $manufacturer['name'] ?></a></li>
<?php }