<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title> Admin Control Panel </title>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">
	<script src="../../assets/app.js">  </script>
</head>
<body>
	<?php
require_once '../../models/User.php';

if (isset($_SESSION['uname'])) {
	$user = new User();
	$user = $user->findByName($_SESSION['uname']);
	if ($user->is_admin == 1) {
		echo "<h1> Hello admin $user->uname </h1>";
		echo "<form method='post' action='../../controllers/auth/SigninController.php'>
				<input type='submit' name='signout' value='Sign Out'>
			</form>";
		echo "<a href='../../views/client/home.php'> Go to homepage </a>";
		echo "<h2> What to manage: </h2>";
		echo "<ul>
				<li> <h3> <a href='articles.php'> Articles </a> </h3> </li>
				<li> <h3> <a href='users.php'> Users </a> </h3> </li>
			</ul>";
	} else {
		echo "<h1> No admin logged in </h1>";
	}
} else {
	echo "<h1> No admin logged in </h1>";
	echo "<a href='../../views/auth/signin.php'> Signin Now </a>";
}
?>
</body>
</html>