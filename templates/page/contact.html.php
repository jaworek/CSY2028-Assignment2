<p>Please call us on 01604 90345 or email <a href="mailto:enquiries@clairscars.co.uk">enquiries@clairscars.co.uk</a></p>

<?php if (count($errors) > 0) { ?>
    <p class="error">Inquiry could not be sent:</p>
    <ul>
        <?php foreach ($errors as $error) { ?>
            <li><?= $error ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<?php //if ($message) { ?>
<!--    <p>Thank you for your inquiry. Staff will soon reply to your request.</p>-->
<?php //} ?>

<form method="post">
    <label>Name:</label>
    <input type="text" name="contact[name]">

    <label>Email:</label>
    <input type="text" name="contact[email]">

    <label>Telephone:</label>
    <input type="text" name="contact[telephone]">

    <label>Inquiry</label>
    <textarea name="contact[message]"></textarea>

    <input type="submit" name="submit" value="Send">
</form>
