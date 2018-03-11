<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2><?= $title ?> Car</h2>

    <?php if ($error) { ?>
        <p class="error">Error</p>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <input type="hidden" name="car[id]" value="<?= $car->id ?? '' ?>"/>
        <label>Car model</label>
        <input type="text" name="car[name]" value="<?= $car->name ?? '' ?>"/>

        <label>Description</label>
        <textarea name="car[description]"><?= $car->description ?? '' ?></textarea>

        <label>Price</label>
        <input type="text" name="car[price]" value="<?= $car->price ?? '' ?>"/>

        <label>Engine type</label>
        <select name="car[engine_type]">
            <option value="Diesel">Diesel</option>
            <option value="Petrol">Petrol</option>
            <option value="Electric">Electric</option>
        </select>

        <label>Mileage</label>
        <input type="number" name="car[mileage]" value="<?= $car->mileage ?? '' ?>">

        <label>Production year</label>
        <input type="number" name="car[production_year]" value="<?= $car->production_year ?? '' ?>">

        <label>Category</label>
        <select name="car[manufacturer_id]">
            <?php foreach ($manufacturers as $manufacturer) {
                if ($car->manufacturer_id == $manufacturer->id) { ?>
                    <option selected="selected" value="<?= $manufacturer->id ?>"><?= $manufacturer->name ?></option>
                <?php } else { ?>
                    <option value="<?= $manufacturer->id ?>"><?= $manufacturer->name ?></option>
                <?php }
            } ?>
        </select>

        <!--    Wrong pathway specified (fixed, add note in documentation)   -->
        <?php if (isset($_GET['id']) && file_exists('images/cars/' . $car->id . '.jpg')) { ?>
            <label>Current image</label>
            <img src="../images/cars/<?= $car->id ?>.jpg"/>
        <?php } ?>

        <label>Product image</label>
        <input type="file" name="image"/>

        <input type="submit" name="submit" value="Save Product"/>

    </form>
</section>