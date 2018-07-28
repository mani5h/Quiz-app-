<?php

session_start();

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
	
	$_SESSION['message']='USER EXISTS';
	header('location:login.php');
}
else{
	$qy= " insert  into user(username , password,totalques,answerscorrect) values ('$name' , '$pass',0,0) ";
	mysqli_query($con, $qy);
	$_SESSION['message']='REGISTRATION SUCCESSFULL';

	header('location:login.php');
}
// echo $name;

?>