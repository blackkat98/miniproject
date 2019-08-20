<?php
require_once '../../Connection.php';

class Model {
	public $table;
	public $class;
	public $defaultFields = ["id", "created_at", "updated_at", "is_admin", "table", "defaultFields", "uniqueFields"];
	public $uniqueFields = array();

	public function getClass() {
		return get_class($this);
	}

	public function __construct() {
		$this->table = "tbl" . $this->getClass();
		$this->class = $this->getClass();

		$con = Connection::getInstance();
		$sql = "DESCRIBE " . $this->table;
		$query = $con->query($sql);

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if (!in_array($row['Field'], $this->defaultFields)) {
				$this->uniqueFields[] = $row['Field'];
			}
		}
	}

	public function getAllFields() {
		$fields = array();

		$con = Connection::getInstance();
		$sql = "DESCRIBE " . $this->table;
		$query = $con->query($sql);

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$fields[] = $row['Field'];
		}

		return $fields;

	}

	public function all() {
		$fields = $this->getAllFields();
		$class = $this->class;
		$con = Connection::getInstance();
		$sql = "SELECT * FROM " . $this->table;
		$query = $con->query($sql);

		$res = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$obj = new $class;
			foreach ($fields as $field) {
				$obj->$field = $row[$field];
			}
			$res[] = $obj;
		}

		return $res;
	}

	public function find($id) {
		$fields = $this->getAllFields();
		$class = $this->class;
		$con = Connection::getInstance();
		$sql = "SELECT * FROM " . $this->table . " WHERE id='" . $id . "' LIMIT 1";
		$query = $con->query($sql);

		$row = $query->fetch(PDO::FETCH_ASSOC);
		$obj = new $class;
		foreach ($fields as $field) {
			$obj->$field = $row[$field];
		}

		return $obj;
	}

	public function describeTable() {
		$str = "(";
		$uniqueFields = $this->uniqueFields;

		foreach ($uniqueFields as $field) {
			$str .= $field . ",";
		}

		$str = substr($str, 0, -1) . ")";

		return $str;
	}

	public function describeClass() {
		$str = "(";
		$uniqueFields = $this->uniqueFields;
		$props = get_object_vars($this);

		foreach ($uniqueFields as $field) {
			$str .= "'" . $props[$field] . "'" . ",";
		}

		$str = substr($str, 0, -1) . ")";

		return $str;
	}

	public function save() {
		$con = Connection::getInstance();
		$table = $this->describeTable();
		$class = $this->describeClass();
		$sql = "INSERT INTO " . $this->table . $table . " VALUES " . $class;
		$query = $con->query($sql);
	}

	public function delete() {
		$id = $this->id;
		$con = Connection::getInstance();
		$sql = "DELETE FROM " . $this->table . " WHERE id='" . $id . "'";
		$query = $con->query($sql);
	}
}
