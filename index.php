<?php 
  session_start(); 

  if (!isset($_SESSION['fullname'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }


  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['fullname']);
  	header("location: login.php");
 
	if (isset($_SESSION['email'])) {
	header('location: form.php');
	}	
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if(isset($_SESSION['fullname'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['fullname']; ?></strong>	
			<a href="form.php">Fill the form </a>
		</p>
    	<p> <a href="login.php" style="color: red;">logout</a> </p>
		<div class="document">
		 <a href="multipleupload.php">Upload Document
		</div>
    <?php endif ?>
    
</div>
		
</body>
</html>
