<section class="right">
    <h2>Log in</h2>

    <?php if (!empty($error)) { ?>
        <div class="error">
            Could not login
        </div>
    <?php } ?>

    <form method="post" style="padding: 40px">
        <label>Enter Email</label>
        <input type="email" name="email"/>

        <label>Enter Password</label>
        <input type="password" name="password"/>

        <input type="submit" name="submit" value="Log In"/>
    </form>
</section>