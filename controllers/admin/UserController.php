<?php
require_once('../../models/User.php');

class UserController
{
	public function destroy($id) {
		$user = new User();
		$user = $user->find($id);
		$user->delete();

		header('Location: ../../views/admin/users.php');
	}
}

if(isset($_POST['delete'])) {
	$uController = new UserController();
	$uController->destroy($_POST['id']);
}