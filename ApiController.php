<?php

// include "PostModel.php";
require "restful_api.php";

use \PDO;
use Model\Post;

class ApiController extends restful_api {
	// private $post = new Post();
	protected $db;

	function __construct(){
		parent::__construct();
	}

	public function connection()
	{
		try {
		    $dbh = new PDO('mysql:host=localhost;dbname=restapi', 'hungtv1501', '0986372030Hung@');
		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		    return $dbh;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}	
	}

	public function getAllData()
	{
		$data = [];
		$sql = "SELECT * FROM posts";
		$stmt = $this->connection()->prepare($sql);
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

	public function getDataById($id)
	{
		$data = [];
		$sql = "SELECT * FROM posts AS a WHERE a.id = 2";
		$stmt = $this->connection()->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':id',$id, PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}

	public function insertData($title, $content)
	{
		$flagInsert = false;
		$sql = "INSERT INTO posts(title,content) VALUES(:title, :content) ";
		$stmt = $this->connection()->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':title',$title, PDO::PARAM_STR);
			$stmt->bindParam(':content',$content, PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flagInsert = true;
			}
			$stmt->closeCursor();
		}
		return $flagInsert;
	}

	public function updateDataById($id, $title, $content)
	{
		$flagUpdate = false;
		$sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
		$stmt = $this->connection()->prepare($sql);
		if ($stmt) {
			# code...
			$stmt->bindParam(':title',$title,PDO::PARAM_STR);
			$stmt->bindParam(':content',$content,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_STR);
			if ($stmt->execute()) {
				# code...
				$flagUpdate = true;
			}
			$stmt->closeCursor();
		}
		return $flagUpdate;
	}

	public function deleteDataById($id)
	{
		$flagDelete = false;
		$sql = "DELETE FROM posts WHERE posts.id = :id";
		$stmt = $this->connection()->prepare($sql);
		if($stmt){
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			if($stmt->execute()){
				$flagDelete = true;
			}
			$stmt->closeCursor();
		}
		return $flagDelete;
	}

	function user(){
		if ($this->method == 'GET')
		{
			echo "1";
			$data = $this->getAllData();
			echo "<pre>";
			print_r($data);
		}
		elseif ($this->method == 'POST'){
			echo "2";
			if ($this->insertData("hung1","123")) {
				$data = $this->getAllData();
				echo "<pre>";
				print_r($data);
			}
		}
		elseif ($this->method == 'PUT'){
			if ($this->updateDataById("5","123456","1234577")) {
				$data = $this->getAllData();
				echo "<pre>";
				print_r($data);
			}
		}
		elseif ($this->method == 'DELETE'){
			if ($this->deleteDataById(11)) {
				$data = $this->getAllData();
				echo "<pre>";
				print_r($data);
			}
		}
	}
}

$user_api = new ApiController();