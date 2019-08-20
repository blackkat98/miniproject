<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title> Article Management </title>
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
	if ($user->is_admin == 1) {
		echo "<h1> Hello admin $user->uname </h1>";
		echo "<form method='post' action='../../controllers/auth/SigninController.php'>
					<input type='submit' name='signout' value='Sign Out'>
				</form>";
		echo "<a href='../../views/admin/panel.php'> Go to Admin Control Panel </a>";
		echo "<h2> Article Data: </h2>";
		echo "<table class='table table-bordered table-striped'>
			<tr>
				<td style='text-align:center;'> <b> ID </b> </td>
				<td style='text-align:center;'> <b> Summary </b> </td>
				<td style='text-align:center;'> <b> Content </b> </td>
				<td style='text-align:center;'> <b> Created At </b> </td>
				<td colspan='2' style='text-align:center;'> <b> Tools </b> </td>
			</tr>
			<tr>
				<form method='post' action='../../controllers/admin/ArticleController.php'>
					<td style='text-align:center;'>  </td>
					<td style='text-align:center;'> <input type='text' name='summary'> </td>
					<td style='text-align:center;'> <textarea name='content'>  </textarea> </td>
					<td style='text-align:center;'>  </td>
					<td colspan='2' style='text-align:center;'> <input type='submit' name='create' value='Create'> </td>
				</form>
			</tr>";
		foreach ($articles as $article) {
			echo "<tr>
				<form method='post' action='../../controllers/admin/ArticleController.php'>
					<td style='text-align:center;'> <input name='id' value='" . $article->id . "' hidden>" . $article->id . "</td>
					<td style='text-align:center;'> <input type='text' name='summary' value='" . $article->summary . "'> </td>
					<td style='text-align:center;'> <textarea name='content'>" . $article->content . "</textarea> </td>
					<td style='text-align:center;'>" . $article->created_at . " </td>
					<td style='text-align:center;'>
						<input type='submit' name='edit' value='Update'>
					</td>
					<td style='text-align:center;'>
						<input type='submit' name='delete' value='Delete'>
					</td>
				</form>
			</tr>";
		}
	} else {
		echo "<h1> No admin logged in </h1>";
	}
} else {
	echo "<h1> No admin logged in </h1>";
}
?>
</body>
</html>