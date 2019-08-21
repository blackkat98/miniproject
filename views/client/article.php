<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
require_once '../../models/Article.php';
$article = new Article();
$article = $article->find($_GET['id']);
echo $article->summary;
?>
	</title>
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
	$article = new Article();
	$article = $article->find($_GET['id']);
	echo "<h1> Hello $user->uname </h1>";
	echo "<form method='post' action='../../controllers/auth/SigninController.php'>
				<input type='submit' name='signout' value='Sign Out'>
			</form>";
	echo "<a href='../../views/client/home.php'> Go to homepage </a>";
	echo "<h2> Article $article->summary : </h2>";
	echo $article->content;
} else {
	echo "<h1> No user logged in </h1>";
}
?>
</body>
</html>