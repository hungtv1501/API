<?php

session_start();

define('PATH_UPLOAD', 'Images/');

$_SESSION['add_image'] = "";
if (isset($_POST['btnUpload']))
{
	if (isset($_FILES['txtFile']))
	{ 
		$nameFile = $_FILES['txtFile']['name'];
		$tmpName = $_FILES['txtFile']['tmp_name'];
		if ($tmpName)
		{
			$up = move_uploaded_file($tmpName, PATH_UPLOAD.$nameFile);
			if ($up)
			{
				$_SESSION['add_image'] = PATH_UPLOAD.$nameFile;
				header("Location:PostController.php/direction");
			}
			else 
			{
				echo "err";
			}	
		}
		else
		{
			echo "fail";
		}
	}
}