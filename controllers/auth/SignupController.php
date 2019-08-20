<?php
require_once '../../models/User.php';

class SignupController {
	public function signup() {
		$uname = $_POST['uname'];
		$upass = hash('md5', $_POST['upass']);
		$newUser = new User($uname, $upass);

		$user = new User();
		$user = $user->findByName($uname);
		if ($user->uname != null) {
			$this->ifFail();
		} else {
			$newUser->save();
			session_start();
			$_SESSION['uname'] = $uname;
			header('Location: ../../views/client/home.php');
		}
	}

	public function ifFail() {
		ob_start();
		setcookie('signup-error', 'User Info Invalid', time() + 1, '/');
		ob_end_flush();
		header('Location: ../../views/auth/signup.php');
	}
}

if (isset($_POST['signup'])) {
	$sController = new SignupController();
	$sController->signup();
}