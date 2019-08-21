<?php
session_start();
if (isset($_SESSION['uname'])) {
	header('Location: ../../views/client/home.php');
}

require_once '../../models/User.php';
error_reporting(0);
if (isset($_COOKIE['keep-signin'])) {
	$cookie = $_COOKIE['keep-signin'];
	$user = new User();
	$user = $user->findByToken($cookie);
	if ($user->uname != null) {
		$_SESSION['uname'] = $user->uname;
		if ($user->is_admin == 1) {
			header('Location: ../../views/admin/panel.php');
		} elseif ($user->is_admin == 0) {
			header('Location: ../../views/client/home.php');
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Signup </title>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">
	<script src="../../assets/app.js">  </script>
	<script src="../../assets/form_validate.js">  </script>
</head>
<body>
	<div class="panel-body">
        <form name="form" action="../../controllers/auth/SignupController.php" method="POST" class="form-horizontal" onsubmit="return formValidate()">
            <div class="form-group">
                <h1> Signup </h1>
            </div>
            <div class="form-group">
                <h2 style="color: red;">
                    <?php
error_reporting(0);
if (isset($_COOKIE['signup-error'])) {
	echo $_COOKIE['signup-error'];
}
?>
                </h2>
            </div>
            <div class="form-group">
                <label for="uname" class="col-sm-3 control-label"> Username: </label>
                <div class="col-sm-6">
                    <input type="text" name="uname" id="uname" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="upass" class="col-sm-3 control-label"> Password: </label>
                <div class="col-sm-6">
                    <input type="password" name="upass" id="upass" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <input name="signup" type="submit" class="btn btn-default" value="Signup">
                    <a href="signin.php"> OR Signin </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>