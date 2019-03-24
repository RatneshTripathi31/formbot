<html>
	<head>
	<meta charset="UTF-8">
		<title>File Upload</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<div class="header">
	 	<h2>Upload Documents </h2>
	</div>
	<form action="myparser.php" method="POST" enctype="multipart/form-data">
	<div class="input-gr">
	<table>
		<tr>
		<td>Aadhar Card </td>
		<td><input name="file_array[]" type="file"></td>
		</tr>
		
		<tr>
		<td>Pan Card </td>
		<td><input name="file_array[]" type="file"></td>
		</tr>
		
		<tr>
		<td>Driving License </td>
		<td><input name="file_array[]" type="file"></td>
		</tr>
	</table>
	<br>
		<input type="submit" value="Upload all files">
		
	</form>	
	</div>
	</body>
</html>



	 
