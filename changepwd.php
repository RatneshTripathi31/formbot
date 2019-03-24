<?php include('server.php') ?>
<?php
  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must enter email first";
	header('location: forgotpwd.php');
  }	
?>

<html>
<head>
  <title>Change Password</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Change Password</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
	<div class="input-group">
  		<label>Email</label>
  		<input type="email" name="email" >
  	</div>
	<div class="input-group">
  		<label>Old Password</label>
  		<input type="password" name="oldpassword" >
  	</div>
  	<div class="input-group">
  		<label>New Password</label>
  		<input type="password" name="newpassword" >
  	</div>
  	<div class="input-group">
  		<label>Confirm Password</label>
  		<input type="password" name="confirmpassword">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="changepwd">Submit</button>
  	</div>
  </form>
</body>
</html>





