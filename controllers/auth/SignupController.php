<?php
require_once '../../models/User.php';

class SignupController {
	public function signup() {
		$uname = $_POST['uname'];
		$upass = $_POST['upass'];

		$user = new User();
		$user = $user->findByName($uname);
		if ($user->uname != null) {
			$this->ifFail();
		} elseif ($user->uname == null) {
			$newUser = new User($uname, $upass);
			$newUser->save();
			session_start();
			$_SESSION['uname'] = $newUser->uname;
			// setcookie('test', $newUser->uname . $newUser->upass, time() + 1000000000, '/');
			header('Location: ../../views/client/home.php');
		}
	}

	public function ifFail() {
		ob_start();
		setcookie('signup-error', 'Username already used', time() + 1, '/');
		ob_end_flush();
		header('Location: ../../views/auth/signup.php');
	}
}

if (isset($_POST['signup'])) {
	$sController = new SignupController();
	$sController->signup();
}