
<?php include('server.php') ?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
 integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
 
  <title>Homepage</title>
  
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
  <div class="row">
  <div class="col-md-4 offset-md-4 form-div login">
	
	 <div class="alert alert-success">
		You are now logged in!
	 </div>
	
	 <h3>Welcome <?php echo $_SESSION['fullname']; ?></h3>
	
	 <?php if($_SESSION['verified']): ?>
	 	 <div class="alert alert-warning"> 
		 You need to verify your accout. Sign in to your email accout and click on 
		 the verification link we just emailed you at <strong><?php echo $_SESSION['email']; ?></strong>
		</div>
	<?php endif; ?>
	<?php if(!$_SESSION['verified']): ?>
		<button type="submit" class="btn btn-block btn-lg btn-primary" name="home_page">I am Verified</button>  
	<?php endif; ?>
	 <a href="login.php" class="logout">logout</a>
</body>
</html>