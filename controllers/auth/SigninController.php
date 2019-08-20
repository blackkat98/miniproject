<?php
require_once '../../models/User.php';

class SigninController {
	public function signin() {
		$uname = $_POST['uname'];
		$upass = hash('md5', $_POST['upass']);

		$user = new User();
		$user = $user->findByName($uname);
		if ($user->uname != null) {
			if ($user->upass == $upass) {
				if (isset($_POST['remember'])) {
					ob_start();
					setcookie('remember-uname', $user->uname, time() + 86400 * 365 * 10, '/');
					ob_end_flush();
				}
				if (isset($_POST['keep'])) {
					ob_start();
					setcookie('keep-login', $user->uname, time() + 86400 * 365 * 10, '/');
					ob_end_flush();
				}
				session_start();
				$_SESSION['uname'] = $uname;
				$this->redirect($user);
			} else {
				$this->ifFail();
			}
		} else {
			$this->ifFail();
		}
	}

	public function redirect(User $user) {
		if ($user->is_admin == 1) {
			header('Location: ../../views/admin/panel.php');
		} elseif ($user->is_admin == 0) {
			header('Location: ../../views/client/home.php');
		}
	}

	public function ifFail() {
		ob_start();
		setcookie('signin-error', 'User Info Invalid', time() + 1, '/');
		ob_end_flush();
		header('Location: ../../views/auth/signin.php');

	}

	public function signout() {
		session_start();
		$_SESSION['uname'] = array();
		session_destroy();

		header('Location: ../../views/auth/signin.php');
	}
}

if (isset($_POST['signin'])) {
	$sController = new SigninController();
	$sController->signin();
}

if (isset($_POST['signout'])) {
	$sController = new SigninController();
	$sController->signout();
}