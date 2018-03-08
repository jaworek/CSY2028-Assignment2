<p>Please call us on 01604 90345 or email <a href="mailto:enquiries@clairscars.co.uk">enquiries@clairscars.co.uk</a></p>

<?php if ($message) { ?>
    <p>Thank you for your inquiry. Staff will soon reply to your request.</p>
<?php } ?>

<form method="post">
    <label>Name:</label>
    <input type="text" name="contact[name]">

    <?= ((isset($error['name']))) ? '<label class="error">Name cannot be empty</label>' : '' ?>

    <label>Email:</label>
    <input type="email" name="contact[email]">

    <?= ((isset($error['email']))) ? '<label class="error">Email cannot be empty</label>' : '' ?>

    <label>Telephone:</label>
    <input type="text" name="contact[telephone]">

    <?= ((isset($error['telephone']))) ? '<label class="error">Telephone cannot be empty</label>' : '' ?>

    <label>Inquiry</label>
    <textarea name="contact[message]"></textarea>

    <input type="submit" name="submit" value="Send">
</form>
