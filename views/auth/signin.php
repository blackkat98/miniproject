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
	<title> Signin </title>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">
	<script src="../../assets/app.js">  </script>
	<script src="../../assets/form_validate.js">  </script>
</head>
<body>
	<div class="panel-body">
        <form name="form" action="../../controllers/auth/SigninController.php" method="POST" class="form-horizontal" onsubmit="return formValidate()">
            <div class="form-group">
                <h1> Signin </h1>
            </div>
            <div class="form-group">
                <h2 style="color: red;">
                    <?php
error_reporting(0);
if (isset($_COOKIE['signin-error'])) {
	echo $_COOKIE['signin-error'];
}
?>
                </h2>
            </div>
            <div class="form-group">
                <label for="uname" class="col-sm-3 control-label"> Username: </label>
                <div class="col-sm-6">
                    <input type="text" name="uname" id="uname" class="form-control" value="<?php error_reporting(0);if (isset($_COOKIE['remember-uname'])) {echo $_COOKIE['remember-uname'];}?>">
                </div>
            </div>
            <div class="form-group">
                <label for="upass" class="col-sm-3 control-label"> Password: </label>
                <div class="col-sm-6">
                    <input type="password" name="upass" id="upass" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="checkbox" name="remember" class="form-control">
                    <label class="col-sm-3 control-label"> Remember Me </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="checkbox" name="keep" class="form-control">
                    <label class="col-sm-3 control-label"> Keep Login </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <input name="signin" type="submit" class="btn btn-default" value="Signin">
                    <a href="signup.php"> OR Signup </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>