<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title> User Management </title>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">
	<script src="../../assets/app.js">  </script>
</head>
<body>
	<?php
require_once '../../models/User.php';

if (isset($_SESSION['uname'])) {
	$user = new User();
	$user = $user->findByName($_SESSION['uname']);
	$users = $user->all();
	if ($user->is_admin == 1) {
		echo "<h1> Hello admin $user->uname </h1>";
		echo "<form method='post' action='../../controllers/auth/SigninController.php'>
					<input type='submit' name='signout' value='Sign Out'>
				</form>";
		echo "<a href='../../views/admin/panel.php'> Go to Admin Control Panel </a>";
		echo "<h2> User Data: </h2>";
		echo "<table class='table table-bordered table-striped'>
					<tr>
						<td style='text-align:center;'> <b> ID </b> </td>
						<td style='text-align:center;'> <b> Username </b> </td>
						<td style='text-align:center;'> <b> MD5-encrypted Password </b> </td>
						<td style='text-align:center;'> <b> Is Admin </b> </td>
						<td style='text-align:center;'> <b> Tools </b> </td>
					</tr>";
		foreach ($users as $user) {
			echo "<tr>
					<td style='text-align:center;'>" . $user->id . "</td>
					<td style='text-align:center;'>" . $user->uname . "</td>
					<td style='text-align:center;'>" . $user->upass . "</td>
					<td style='text-align:center;'>" . $user->is_admin . "</td>
					<td style='text-align:center;'>";
			if ($user->is_admin == 0) {
				echo "<form method='post' action='../../controllers/admin/UserController.php'>
							<input type='text' name='id' value='" . $user->id . "' hidden>
							<input type='submit' name='delete' value='Delete'>
						</form>";
			}
			echo "</td>
				</tr>";
		}
		echo "</table>";
	} else {
		echo "<h1> No admin logged in </h1>";
	}
} else {
	echo "<h1> No admin logged in </h1>";
}
?>
</body>
</html>