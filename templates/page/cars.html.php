<?php foreach ($cars as $car) {
    foreach ($manufacturers as $manufacturer) {
        if ($manufacturer['id'] === $car['manufacturer_id']) {
            break;
        }
    } ?>

    <li>
        <?php if (file_exists("images/cars/{$car['id']}.jpg")) { ?>
            <a href="images/cars/<?= $car['id'] ?>.jpg"><img src="/images/cars/<?= $car['id'] ?>.jpg"/></a>
        <?php } ?>

        <div class="details">
            <h2><?= $manufacturer['name'], ' ', $car['name'] ?></h2>
            <h3><?= (empty($car['earlier_price'])) ? "£{$car['price']}" : "Was £{$car['earlier_price']}, now £{$car['price']}"; ?></h3>
            <h3>Mileage: <?= $car['mileage'] ?></h3>
            <h3>Engine type: <?= $car['engine_type'] ?></h3>
            <h3>Production year: <?= $car['production_year'] ?></h3>
            <p><?= $car['description'] ?></p>
        </div>
    </li>
<?php } ?>