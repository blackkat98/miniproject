<?php
session_start();
if (isset($_SESSION['uname'])) {
	header('Location: views/client/home.php');
} else {
	header('Location: views/auth/signin.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Index </title>
</head>
<body>
	<ul>
		<li> <h1> <a href="views/auth/signin.php"> Sign In </a> </h1> </li>
		<li> <h1> <a href="views/auth/signup.php"> Sign Up </a> </h1> </li>
	</ul>
</body>
</html>