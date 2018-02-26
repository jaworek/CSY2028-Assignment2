<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Add Car</h2>

    <form method="POST" enctype="multipart/form-data">
        <label>Car Model</label>
        <input type="text" name="model">

        <label>Description</label>
        <textarea name="description"></textarea>

        <label>Price</label>
        <input type="text" name="price">

        <label>Category</label>
        <select name="manufacturerId">
            <?php foreach ($manufacturers as $manufacturer) { ?>
                <option value="<?php $manufacturer['id'] ?>"><?= $manufacturer['name'] ?></option>
            <?php } ?>
        </select>

        <label>Image</label>
        <input type="file" name="image">

        <input type="submit" name="submit" value="Add Car">

    </form>
</section>