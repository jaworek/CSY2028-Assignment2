<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Add staff account</h2>

    <?php if ($error) { ?>
        <p class="error">Error</p>
    <?php } ?>

    <form method="post">
        <label>Email</label>
        <input name="staff[email]" type="email">

        <label>Password</label>
        <input name="staff[password]" type="password">

        <label>Repeat password</label>
        <input name="password2" type="password">

        <label>Name</label>
        <input name="staff[name]" type="text">

        <input name="submit" type="submit" value="Add account">
    </form>
</section>