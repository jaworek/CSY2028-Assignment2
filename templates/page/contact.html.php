<p>Please call us on 01604 90345 or email <a href="mailto:enquiries@clairscars.co.uk">enquiries@clairscars.co.uk</a></p>

<?php if ($message) { ?>
    <p>Thank you for your inquiry. Staff will soon reply to your request.</p>
<?php } ?>

<form method="post">
    <label>Name:</label>
    <input type="text" name="contact[name]">

    <?= ((isset($error['name']))) ? '<label class="error">Name cannot be empty</label>' : '' ?>

    <label>Email:</label>
    <input type="text" name="contact[email]">

    <?= ((isset($error['empty_email']))) ? '<label class="error">Email cannot be empty</label>' : '' ?>
    <?= ((isset($error['wrong_email']))) ? '<label class="error">This is not a valid email</label>' : '' ?>

    <label>Telephone:</label>
    <input type="text" name="contact[telephone]">

    <?= ((isset($error['telephone']))) ? '<label class="error">Telephone cannot be empty</label>' : '' ?>

    <label>Inquiry</label>
    <textarea name="contact[message]"></textarea>

    <?= ((isset($error['message']))) ? '<label class="error">Message cannot be empty</label>' : '' ?>

    <input type="submit" name="submit" value="Send">
</form>
