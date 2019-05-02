<?php
	class Database
	{
		private static $dbhost = "localhost";
		private static $dbname = "final";
		private static $dbUser = "root";
		private static $dbUserPassword = "root";

		private static $connection = null;

		public static function connect()
		{
			try
			{
				self::$connection = new PDO("mysql:host=" . self::$dbhost . "; dbname=" . self::$dbname,self::$dbUser,self::$dbUserPassword);
			}
			catch(Exception $e)
			{
				die($e->getMessage());
			}
			return self::$connection;
		}

		public static function disconnect()
		{
			self::$connection = null;
		}
	}

	Database::connect();
?>