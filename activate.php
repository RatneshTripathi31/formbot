<?php include('server.php');
?>

<?php 

if(isset($_GET["code"]))
{
	$usercode=$_GET["code"];
	$query="select * from users where ucode='$usercode'";
	$query1=mysqli_query($db,$query);
	$data=mysqli_fetch_row($query1);
	if($data>0){
		mysqli_query($db,"update user set vstatus=1 where ucode='$usercode' ");
		echo "Your Email is Verified Now login in to System.";
	}
}
?>