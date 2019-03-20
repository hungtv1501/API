<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Demo Upload File len Server</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="UploadImages.php" method="POST" enctype="multipart/form-data">
		<label for="txtFile">Moi chon file</label>
		<br><br>
		<input type="file" name="txtFile" id="txtFile">
		<br><br>
		<button type="submit" name="btnUpload">Upload File</button>
	</form>
</body>
</html>