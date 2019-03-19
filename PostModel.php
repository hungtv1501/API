<?php

namespace Model;

require 'ConfigDatabase.php';

use \PDO;
use Config\Database;

/**
 * 
 */
class Post extends Database
{
	// echo "10";
	function __construct()
	{
		echo "0";
		parent::__construct();
	}

	public function getAllData()
	{
		echo "1";
		$data = [];
		$sql = "SELECT * FROM posts";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			if ($stmt->execute()) {
				# code...
				if ($stmt->rowCount() > 0) {
					# code...
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		echo "<pre>";
		print_r($data);
	}
}
