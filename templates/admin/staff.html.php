<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Staff</h2>

    <a href="/admin/addstaff">Add new staff account</a>

    <?php foreach ($staff as $employee) { ?>
        <div>
            <p><?= $employee['email'] ?> <a href="/admin/deletestaff?id=<?= $employee['id'] ?>">Delete</a></p>
        </div>
    <?php } ?>
</section>