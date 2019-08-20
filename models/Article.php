<?php
require_once 'Model.php';

class Article extends Model {
	public $id;
	public $summary;
	public $content;
	public $created_at;
	public $updated_at;

	public function __construct($summary = "", $content = "") {
		parent::__construct();
		$this->summary = $summary;
		$this->content = $content;
	}
}