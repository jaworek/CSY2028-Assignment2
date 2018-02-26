<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Manufacturers</h2>

    <a class="new" href="/admin/addmanufacturer">Add new manufacturer</a>


    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th style="width: 5%">&nbsp;</th>
            <th style="width: 5%">&nbsp;</th>
        </tr>

        <?php foreach ($categories as $category) { ?>
            <tr>
                <td><?= $category['name'] ?></td>
                <td><a style="float: right" href="/admin/editmanufacturer?id=<?= $category['id'] ?>">Edit</a></td>
                <td><a style="float: right" href="/admin/deletemanufacturer?id=<?= $category['id'] ?>">Delete</a></td>
            </tr>
        <?php } ?>
        </thead>
    </table>
</section>