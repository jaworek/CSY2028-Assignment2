<?php
$pdo = new PDO('mysql:dbname=cars;host=127.0.0.1', 'student', 'student');
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/styles.css"/>
		<title>Claires's Cars - Admin</title>
	</head>
	<body>
	<header>
		<section>
			<aside>
				<h3>Opening Hours:</h3>
				<p>Mon-Fri: 09:00-17:30</p>
				<p>Sat: 09:00-17:00</p>
				<p>Sun: 10:00-16:00</p>
			</aside>
			<img src="/images/logo.png"/>

		</section>
	</header>
		
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/cars.php">Showroom</a></li>
			<li><a href="/about.html">About Us</a></li>
			<li><a href="/contact.php">Contact us</a></li>
		</ul>
	</nav>

	<img src="/images/randombanner.php"/>
	<main class="admin">
		
	<?php
	if (isset($_POST['submit'])) {
		if ($_POST['password'] == 'opensesame') {
			$_SESSION['loggedin'] = true;	
		}
	}


	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	?>

	<section class="left">
		<ul>
			<li><a href="manufacturers.php">Manufacturers</a></li>
			<li><a href="cars.php">Cars</a></li>

		</ul>
	</section>

	<section class="right">
	<h2>You are now logged in</h2>
	</section>
	<?php
	}

	else {
		?>
		<h2>Log in</h2>

		<form action="index.php" method="post" style="padding: 40px">

			<label>Enter Password</label>
			<input type="password" name="password" />

			<input type="submit" name="submit" value="Log In" />
		</form>
	<?php
	}
	?>


	</main>

	<footer>
		&copy; Claire's Cars 2018
	</footer>
</body>
</html>
