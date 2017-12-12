<?php

session_start();

if(isset($_POST['submit'])) {

echo $_POST['submit'];


//create connection 
$conn=new mysqli("localhost","root","","shopnepal");
//if connection error occured
if($conn->connect_error){
  die ("connection failed").$conn->connect-error;
}


$username=$_POST['username'];
$userpasswords=$_POST['userpassword'];
//creating  the message digent before checking to the database value
$userpassword=md5($userpasswords);



//sql statement 
$sql ="SELECT name password From member WHERE name='$username' AND password='$userpassword';";

//executin sql query statemnt 
$result=$conn->query($sql);
echo "query executed";
//fetch row 
$row = mysqli_fetch_row($result);


//checking whether result is null or not 
if (is_null($row)) {
	 echo "sign in unsucessful";
	 echo '<style> background:red;</style>';

	 echo '<script>alert("please enter correct username and password");
	  window.location.href="index.php";

	 </script>
	
	 ';
	 	
	 }
	 else{
	 	$_SESSION['user']=$username;
	 	echo "query executed sucessfully";
	 	echo $_SESSION['user'];


//if id is set to 
	 	if (isset($_GET['id'])) {
	 		header('Location:products/product_detail.php?user='.$username);
	 	}
	 	else{
	 				 	header('Location:index.php?user='.$username);


	 	}

	 	

	 }
}
?>


