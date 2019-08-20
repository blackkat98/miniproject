<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title> Homepage </title>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">
	<script src="../../assets/app.js">  </script>
</head>
<body>
	<?php
require_once '../../models/User.php';
require_once '../../models/Article.php';

if (isset($_SESSION['uname'])) {
	$user = new User();
	$user = $user->findByName($_SESSION['uname']);
	$articles = new Article();
	$articles = $articles->all();
	echo "<h1> Hello $user->uname </h1>";
	echo "<form method='post' action='../../controllers/auth/SigninController.php'>
		<input type='submit' name='signout' value='Sign Out'>
	</form>";
	if ($user->is_admin == 1) {
		echo "<a href='../../views/admin/panel.php'> Go to Admin Control Panel </a>";
	}
	echo "<h2> All Articles: </h2>";
	echo "<ul>";
	foreach ($articles as $article) {
		echo "<li>
			<form method='get' action='article.php'>
				<input type='text' name='id' value='" . $article->id . "' hidden>
				<input style='font-size: 18px;' type='submit' name='detail' value='" . $article->summary . "''>
			</form>
		</li>";
	}
	echo "</ul>";
} else {
	echo "<h1> No user logged in </h1>";
	echo "<a href='../../views/auth/signin.php'> Signin Now </a>";
}
?>
</body>
</html>