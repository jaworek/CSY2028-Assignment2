<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/css/styles.min.css"/>
		<title>Claires's Cars - <?= $title ?></title>
	</head>
	<body>
	<header>
		<section>
			<aside>
				<h3>Opening Hours:</h3>
				<p>Mon-Fri: 09:00-17:30</p>
				<p>Sat: 09:00-17:00</p>
				<p>Sun: Closed</p>
			</aside>
			<img src="/images/logo.png"/>

		</section>
	</header>
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/cars/showroom">Showroom</a></li>
			<li><a href="/page/about">About Us</a></li>
			<li><a href="/page/contact">Contact us</a></li>
			<li><a href="/page/careers">Claire’s Careers</a></li>
		</ul>
	</nav>
<img src="/images/randombanner.php"/>
	<main class="<?= $class ?>">
        <?= $output ?>
	</main>


	<footer>
		&copy; Claire's Cars 2018
	</footer>
</body>
</html>
