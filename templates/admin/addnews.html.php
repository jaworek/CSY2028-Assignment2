<?php require 'sidepanel.html.php'; ?>

<section class="right">
    <h2>Add news article</h2>

    <form method="post">
        <label>Title</label>
        <input type="text" name="news[title]">

        <label>Content</label>
        <textarea name="news[content]"></textarea>

        <input type="submit" name="submit" value="Submit">
    </form>
</section>