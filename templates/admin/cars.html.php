<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Cars</h2>

    <?php if (strtolower(ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/')) === 'admin/cars') { ?>
        <a class="new" href="/admin/addcar">Add new car</a>
    <?php } ?>

    <table>
        <thead>
        <tr>
            <th style="width: 10%">Model</th>
            <th style="width: 10%">Price</th>
            <th style="width: 5%">&nbsp;</th>
            <th style="width: 5%">&nbsp;</th>
            <th style="width: 5%">&nbsp;</th>
        </tr>

        <?php foreach ($cars as $car) { ?>
            <tr>
                <td><?= $car->name ?></td>
                <td>£<?= $car->price ?></td>
                <td><a style="float: right"
                       href="/admin/archive?id=<?= $car->id ?>"><?= ($car->archived == 'false') ? 'Archive' : 'Restore'; ?></a>
                </td>
                <td><a style="float: right" href="/admin/editcar?id=<?= $car->id ?>">Edit</a></td>
                <td><a style="float: right" href="/admin/deletecar?id=<?= $car->id ?>">Delete</a></td>
            </tr>
        <?php } ?>

        </thead>
    </table>
</section>