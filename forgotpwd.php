
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
  <div class="header">
  	<h2>Forgot Password</h2>
  </div>
	 
  <form method="post" action="forgotpwd.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Email</label>
  		<input type="email" name="email" >
  	</div>
  	
  	<div class="input-group">
  		<button type="submit" class="btn" name="forgotpwd">Submit</button>
  	</div>
 
  </form>
</body>
</html>
