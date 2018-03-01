<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Inquires</h2>

    <?php foreach ($inquires as $inquiry) { ?>
        <div>
            <?= $inquiry['message'] ?>
            <?php if ($inquiry['complete'] == 'false') { ?>
                <a href="/admin/complete?id=<?= $inquiry['id'] ?>">Complete</a>
            <?php } ?>
        </div>
    <?php } ?>
</section>