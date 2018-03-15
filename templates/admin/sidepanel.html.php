<section class="left">
    <ul>
        <li><a href="/admin/manufacturers">Manufacturers</a></li>
        <li><a href="/admin/cars">Cars</a></li>
        <li><a href="/admin/archivedcars">Archived cars</a></li>
        <li><a href="/admin/inquires">Inquires</a></li>
        <li><a href="/admin/completeinquires">Complete inquires</a></li>
        <?php if ($_SESSION['username'] == 'claire@claire.com') { ?>
            <li><a href="/admin/staff">Staff</a></li>
        <?php } ?>
        <li><a href="/admin/news">News</a></li>
        <li><a href="/admin/logout">Logout</a></li>
    </ul>
</section>