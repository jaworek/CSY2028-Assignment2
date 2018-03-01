<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Staff</h2>

    <a href="/admin/addstaff">Add new staff account</a>

    <?php foreach ($staff as $employee) { ?>
        <div>
            <?= $employee['email'] ?>
        </div>
    <?php } ?>
</section>