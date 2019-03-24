<?php 
$link=mysqli_connect('localhost', 'root', 'root', 'registration');
?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Google Form</title>
  <link rel="stylesheet" type="text/css" href="newform.css">
</head>
<body>
  <div class="header">
  
  </div>
	
  <form method="post" action="form.php">
  <?php include('errors.php'); ?>
	
	 <?php
	 
		$email=$_SESSION['email'];
		$res=mysqli_query($link,"SELECT * FROM users where email='$email'");
		while($row=mysqli_fetch_assoc($res))
		{		
	 ?>
	 
	<div class="login">
	<div class="login-triangle"></div>
	<h2 class="login-header">Automatic Form Filling</h2>
	<form class="login-container">
	 <p>Full Name<input type="text" name="fullname"  value="<?php echo $row["fullname"]; ?>"> </p>
	 <p>Email<input type="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" value="<?php echo $row["email"]; ?>">  </p>
     <p>Mobile Number<input type="text" name="mobileno" pattern="[789][0-9]{9}" value="<?php echo $row["mobileno"]; ?>"> </p>
	 <p><input type="submit" name="sam_form" value="Fill the Form"></p>
 
   </form>
</div>
	<?php
		}
		?>
	  </form>
</body>
</html>