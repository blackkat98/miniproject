<?php
require_once('Model.php');

class User extends Model
{
	public $id;
	public $uname;
	public $upass;
	public $is_admin;
	public $created_at;

	public function __construct($uname = "", $upass = "") {
		parent::__construct();
		$this->uname = $uname;
		$this->upass = hash("md5", $upass);
	}

	public function findByName($uname) {
		$con = Connection::getInstance();
		$sql = "SELECT * FROM tblUser WHERE uname='" . $uname . "' LIMIT 1";
		$query = $con->query($sql);

		$row = $query->fetch(PDO::FETCH_ASSOC);
		$user = new User();
		$user->id = $row['id'];
		$user->uname = $row['uname'];
		$user->upass = $row['upass'];
		$user->is_admin = $row['is_admin'];	
		$user->created_at = $row['created_at'];	

		return $user;
	}
}