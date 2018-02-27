<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Edit Car</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $car['id']; ?>"/>
        <label>Name</label>
        <input type="text" name="name" value="<?= $car['name']; ?>"/>

        <label>Description</label>
        <textarea name="description"><?= $car['description']; ?></textarea>

        <label>Price</label>
        <input type="text" name="price" value="<?= $car['price']; ?>"/>

        <label>Category</label>
        <select name="manufacturerId">
            <?php foreach ($manufacturers as $manufacturer) {
                if ($car['categoryId'] == $manufacturer['id']) { ?>
                    <option selected="selected" value="<?= $manufacturer['id'] ?>"><?= $manufacturer['name'] ?></option>
                <?php } else { ?>
                    <option value="<?= $manufacturer['id'] ?>"><?= $manufacturer['name'] ?></option>
                <?php }
            } ?>
        </select>

        <!--    Wrong pathway specified (fixed, add note in documentation)   -->
        <?php if (file_exists('images/cars/' . $car['id'] . '.jpg')) { ?>
            <label>Current image</label>
            <img src="../images/cars/<?= $car['id'] ?>.jpg"/>
        <?php } ?>

        <label>Product image</label>
        <input type="file" name="image"/>

        <input type="submit" name="submit" value="Save Product"/>

    </form>
</section>