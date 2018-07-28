<html>
<head>
	<title>	
		QUIZ APP
	</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<br/>
	<h1 class="text-center " style="color: blue">WELCOME TO QUIZAPP</h1>
</head>
<body>
	<div class="jumbotron">
		<div class="container">
			<div class ="row">
				<div class="col-lg-6">
					<div class="card">
					<h2 class="text-center card-header"> LOGIN FORM </h2>
					<form action="validation.php" method="post">
						<div class="form-group">
							<label>USERNAME </label>
							<input type="text" name="uname" class="flow-contol">
						</div>
						<div class="form-group">
							<label>Password </label>
							<input type="Password" name="password" class="flow-contol">
						</div>
						<button type="submit" class="btn btn-primary">Login </button>
					</form>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card">
					<h2 class="text-center card-header"> SIGNIN FORM </h2>
					<form action="registration.php" method="post">
						<div class="form-group">
							<label>USERNAME </label>
							<input type="text"  name="uname" class="flow-contol">
						</div>
						<div class="form-group">
							<label>Password </label>
							<input type="Password" name="password" class="flow-contol">
						</div>
						<button type="submit" class="btn btn-primary">Sign In </button>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="jumbotron">
<?php
session_start();
if(isset($_SESSION['message']))
	echo $_SESSION['message'];

?>
</div>
</body>
</html>