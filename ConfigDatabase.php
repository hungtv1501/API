<?php

namespace Config;

use \PDO;

class Database {
	public function connection() {
		$servername = "localhost";
		$username = "root";
		$password = "Root@123";
		try {
			$conn = new PDO("mysql:host=localhost;dbname=restapi", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}
}
?>