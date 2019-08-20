<?php
session_start();
if (isset($_SESSION['uname'])) {
	header('Location: ../../views/client/home.php');
}

require_once '../../models/User.php';

if (isset($_COOKIE['keep-login'])) {
	$uname = $_COOKIE['keep-login'];
	$user = new User();
	$user = $user->findByName($uname);
	if ($user->is_admin == 1) {
		header('Location: ../../views/admin/panel.php');
	} elseif ($user->is_admin == 0) {
		header('Location: ../../views/client/home.php');
	}
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