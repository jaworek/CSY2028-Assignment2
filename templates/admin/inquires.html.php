<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Inquires</h2>

    <?php foreach ($inquires as $inquiry) { ?>
        <div class="inquiry">
            <p>Name: <?= $inquiry['name'] ?></p>
            <p>Email: <?= $inquiry['email'] ?></p>
            <p>Message: <?= $inquiry['message'] ?></p>

            <?php if ($inquiry['admin_id'] == null) { ?>
                <a href="/admin/complete?id=<?= $inquiry['id'] ?>">Complete</a>
            <?php } elseif ($inquiry['admin_id'] != null) { ?>
                <p>Inquiry completed by: <?= $inquiry['admin_id'] ?></p>
            <?php } ?>
        </div>
    <?php } ?>
</section>