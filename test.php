<?php
require 'Connection.php';

$con = Connection::getInstance();
$sql = "DESCRIBE tblUser";
$query = $con->query($sql);

$defaultFields = ["id", "created_at", "updated_at", "is_admin", "table", "defaultFields", "uniqueFields", "remember_token"];
$uniqueFields = array();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	if (!in_array($row['Field'], $defaultFields)) {
		$uniqueFields[] = $row['Field'];
	}
}

foreach ($uniqueFields as $field) {
	echo $field;
}