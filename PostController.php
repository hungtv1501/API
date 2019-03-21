<?php

include "PostModel.php";
require "RestfulApi.php";

use Model\Post;

session_start();

class PostController extends RestfulApi {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = Post::getAllData();
		echo "<pre>";
		print_r($data);
	}

	public function create($title, $content) {
		echo "2";
		if (Post::insertData($title, $content)) {
			echo "3";
			$this->index();
		}
	}

	public function update($id, $title, $content) {
		if (Post::updateDataById($id, $title, $content)) {
			$this->index();
		}
	}

	public function edit($id, $content) {
		if (Post::editDataById($id, $content)) {
			$this->index();
		}
	}

	public function destroy($id) {
		if (Post::deleteDataById($id)) {
			$this->index();
		}
	}

	function directional() {
		if ($this->method == 'GET') {
			if (Post::editDataById("3", $_SESSION['add_image'])) {
				echo "Update";
				$this->index();
				die;
			}
		} elseif ($this->method == 'PATCH') {
			$this->edit("3", "hung1hah123");
		} elseif ($this->method == 'POST') {
			echo "2";
			$this->create("hung 123456", "123");
		} elseif ($this->method == 'PUT') {
			$this->update("5", "12345hung6", "aloalo");
		} elseif ($this->method == 'DELETE') {
			$this->destroy(17);
		}
	}
}

$user_api = new PostController();
?>