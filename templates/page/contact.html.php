<p>Please call us on 01604 90345 or email <a href="mailto:enquiries@clairscars.co.uk">enquiries@clairscars.co.uk</a></p>
<form method="post">
    <label>Name:</label>
    <input type="text" name="name">

    <label>Email:</label>
    <input type="email" name="email">

    <label>Telephone:</label>
    <input type="text" name="telephone">

    <label>Inquiry</label>
    <textarea name="message"></textarea>

    <input type="submit" name="submit" value="Send">
</form>

<?php if ($message) { ?>
    <p>Thank you for your inquiry. Staff will soon reply to your request.</p>
<?php } ?>
