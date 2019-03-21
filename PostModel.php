<?php

namespace Model;

include 'ConfigDatabase.php';

use Config\Database;
use \PDO;

/**
 *
 */
class Post extends Database {
	function __construct() {
		parent::__construct();
	}

	public function getAllData() {
		$data = [];
		$sql = "SELECT * FROM posts";
		$stmt = Database::connection()->prepare($sql);
		if ($stmt) {
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}

	public function getDataById($id) {
		$data = [];
		$sql = "SELECT * FROM posts AS a WHERE a.id = 2";
		$stmt = Database::connection()->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}

	public function editDataById($id, $content) {
		$flagEdit = false;
		$sql = "UPDATE posts SET content = :content WHERE id = :id";
		$stmt = Database::connection()->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':content', $content, PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flagEdit = true;
			}
			$stmt->closeCursor();
		}
		return $flagEdit;
	}

	public function insertData($title, $content) {
		echo "3";
		$flagInsert = false;
		$sql = "INSERT INTO posts(title,content) VALUES(:title, :content) ";
		$stmt = Database::connection()->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':title', $title, PDO::PARAM_STR);
			$stmt->bindParam(':content', $content, PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flagInsert = true;
			}
			$stmt->closeCursor();
		}
		return $flagInsert;
	}

	public function updateDataById($id, $title, $content) {
		$flagUpdate = false;
		$sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
		$stmt = Database::connection()->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':title', $title, PDO::PARAM_STR);
			$stmt->bindParam(':content', $content, PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flagUpdate = true;
			}
			$stmt->closeCursor();
		}
		return $flagUpdate;
	}

	public function deleteDataById($id) {
		$flagDelete = false;
		$sql = "DELETE FROM posts WHERE posts.id = :id";
		$stmt = Database::connection()->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flagDelete = true;
			}
			$stmt->closeCursor();
		}
		return $flagDelete;
	}
}
?>