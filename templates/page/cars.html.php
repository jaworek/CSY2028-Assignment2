<?php foreach ($cars as $car) { ?>

    <li>
        <?php
        for ($i = 0; $i < 4; $i++) {
            if (file_exists("images/cars/{$car->id}.jpg")) { ?>
                <img src="/images/cars/<?= $car->id ?>.jpg"/>
            <?php }
        } ?>

        <div class="details">
            <h2><?= $car->getManufacturer()->name, ' ', $car->name ?></h2>
            <h3><?= (empty($car->earlier_price)) ? "£{$car->price}" : "Was £{$car->earlier_price}, now £{$car->price}"; ?></h3>
            <h3>Mileage: <?= $car->mileage ?></h3>
            <h3>Engine type: <?= $car->engine_type ?></h3>
            <h3>Production year: <?= $car->production_year ?></h3>
            <p><?= $car->description ?></p>
        </div>
    </li>
<?php } ?>