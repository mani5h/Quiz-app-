<?php

session_start();
// header('location:login.php');
$con = mysqli_connect('localhost','root');
if($con)
	echo "connection successful";
else
	echo "connection failed";

mysqli_select_db($con,'quizdb');

$name =$_POST['uname'];
$pass =$_POST['password'];

$q = " select * from user  where username = '$name' && password = '$pass' ";

$result = mysqli_query($con, $q);

$num = mysqli_num_rows($result);

if($num==1){
	
	$q = " select uid from user  where username = '$name' && password = '$pass' ";
	// echo $name.$pass;
	$_SESSION['username'] = $name;
	$result=mysqli_query($con,$q);
	$rows = mysqli_fetch_array($result,MYSQLI_NUM);
	// echo $rows[0];
	$_SESSION['uid'] =$rows[0];
	header('location:home.php');
}
else{
	$_SESSION['message']="INVALID LOGIN CREDENTIALS";
	header('location:login.php');
}
// echo $name;

?>