<section class="right">
    <h2>Log in</h2>

    <?php if (count($errors) > 0) { ?>
        <p class="error">Could not login:</p>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?= $error ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form method="post" style="padding: 40px">
        <label>Enter Email</label>
        <input type="email" name="email"/>

        <label>Enter Password</label>
        <input type="password" name="password"/>

        <input type="submit" name="submit" value="Log In"/>
    </form>
</section>