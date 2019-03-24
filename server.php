<?php
session_start();

// initializing variables

$email    = "";
$errors = array(); 
$fullname="";
$mobileno="";


// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {

	
  // receive all input values from the form
  $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
  $mobileno = mysqli_real_escape_string($db, $_POST['mobileno']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fullname)) { array_push($errors, "Full Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($mobileno)) { array_push($errors, "Mobile Number is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same email
  $user_check_query = "SELECT * FROM users WHERE  email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $result="";

  if ($user) { // if user exists
   
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
	
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
	$code=md5(uniqid());
	
	$token=rand(0,1000);
	$verified=1;
	
  	$query = "INSERT INTO users (fullname, email, mobileno, password, token, verified, ucode) 
  			  VALUES('$fullname', '$email', '$mobileno', '$password' ,'$token', '$verified', '$code')";

  	$query1=mysqli_query($db, $query);
	if($query1){
		
	$subject="Email verification";
	$message="Email verified Successfully. http://localhost/Module3/activate.php?code=$code ";

	if(mail($email,$subject,$message)){
			echo "Mail send Successfully";
		}else{
		echo "Mail not send.";
		
	}
	}
	$fetch_fullname = "SELECT * FROM users WHERE  email='$email'";
	$result = mysqli_query($db,$fetch_fullname);
    $user = mysqli_fetch_assoc($result);
  	$_SESSION['fullname'] = $user['fullname'];
	$_SESSION['verified'] = $user['verified'];
	$_SESSION['email']=$email;
	$_SESSION['success'] = "You are now logged in";
  	header('location: Homepage.php');
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  //$fullname = mysqli_real_escape_string($db, $_POST['fullname']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($results);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['fullname'] = $user['fullname'];
	  $_SESSION['email']=$email;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}
	} else {
  		array_push($errors, "Wrong email/password combination");
  	}
  }


// LOGIN ADMIN
if (isset($_POST['login_admin'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  //$fullname = mysqli_real_escape_string($db, $_POST['fullname']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($results);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['fullname'] = $user['fullname'];
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index1.php');
  	}
	
  	} else {
  		array_push($errors, "Wrong email/password combination");
  	}
  }

//Forgot Password  
if (isset($_POST['forgotpwd'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);

  if (empty($email)) {
  	array_push($errors, "email is required");
  }

  if (count($errors) == 0) {
  	//$password = md5($password);
		
  	$query = "SELECT * FROM users WHERE email='$email' ";
  	$results = mysqli_query($db, $query);
	
	$user = mysqli_fetch_assoc($results);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['email'] = $user['email'];
	  //$password=md5($user['password']);
	  $subject="Forgot Password";
	  $message="Hi $email set your password http://localhost/Module3/setnewpwd.php?email=$email";

	  if(mail($email,$subject,$message)){
			echo "Your Password has been sent on your Email Id.";
		}else{
		echo "Mail not send.";
		}  
  	 }
  } else {
  		array_push($errors, "Wrong email/password combination");
  	}
}

if (isset($_POST['changepwd'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $oldpassword = mysqli_real_escape_string($db, $_POST['oldpassword']);
  $oldpassword = md5($oldpassword);
  
  $newpassword= mysqli_real_escape_string($db, $_POST['newpassword']);
  $confirmpassword= mysqli_real_escape_string($db, $_POST['confirmpassword']);
  //$confirmpassword=md5(confirmpassword);
  
  if($newpassword != $confirmpassword){
	  array_push($errors, "The two passwords do not match");
  }
  
  if (count($errors) == 0) {
	
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$oldpassword' ";
  	$results = mysqli_query($db, $query);
	
	$user = mysqli_fetch_assoc($results);
  	if (mysqli_num_rows($results) == 1) {
		$newpassword=md5($newpassword);
		$query="update users set password='$newpassword' where email='$email' ";
		$result=mysqli_query($db,$query);  
		echo "Update Password Successfully.";
		
	}else{
		echo "Password Not Updated Successfully.";
		}  
  	 }
  }



if (isset($_POST['setnewpwd'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  
  $newpassword= mysqli_real_escape_string($db, $_POST['newpassword']);
  $confirmpassword= mysqli_real_escape_string($db, $_POST['confirmpassword']);
  //$confirmpassword=md5(confirmpassword);
  
  if($newpassword != $confirmpassword){
	  array_push($errors, "The two passwords do not match");
  }
  
  if (count($errors) == 0) {
	
  	$query = "SELECT * FROM users WHERE email='$email' ";
  	$results = mysqli_query($db, $query);
	
	$user = mysqli_fetch_assoc($results);
  	if (mysqli_num_rows($results) == 1) {
		$newpassword=md5($newpassword);
		$query="update users set password='$newpassword' where email='$email' ";
		$result=mysqli_query($db,$query);  
		echo "Change Password Successfully.";
		
	}else{
		echo "Password Does not changed.";
		}  
  	 }
  }
?>