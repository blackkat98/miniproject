<?php
	class Connection
	{
		private static $instance = null;

		public static function getInstance()
		{
			if(!isset(self::$instance))
			{
				try
				{
					self::$instance = new PDO('mysql:host=localhost;dbname=photosharing', 'root', '');
					self::$instance->exec("SET NAMES utf8");
				}
				catch(PDOException $ex)
				{
					die($ex->getMessage());
				}
			}

			return self::$instance;
		}
	}