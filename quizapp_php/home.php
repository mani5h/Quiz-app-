<?php

session_start();
if(!isset($_SESSION['username']))
	header('location:login.php');
$con = mysqli_connect('localhost','root');
		if(!$con)
			echo "connection failed";
		mysqli_select_db($con,'quizdb')
?>

<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<br> <h1 class="text-center text-primary"> QUIZAPP </h1><br>
		<div class="col-lg-8 m-auto d-block">
			<div class="card" >

			<h2 class="text-center">Welcome <?php echo $_SESSION['username']; ?></h2>
			<form action="check.php" method="post">
			<?php

				$q = " select * from questions ";

				$result = mysqli_query($con, $q);

				$n = mysqli_num_rows($result);
				
				for($i=1;$i<=$n;$i++){
					
					$q = "select * from questions where qid=$i";
					$query=mysqli_query($con,$q);
					while($rows=mysqli_fetch_array($query)){	
					?>
					<div class="card">
						<h3 class="card-header"><?php echo $rows['question'] ?></h3>
					</div>
					<?php 
						$q=" select * from answers where ans_id = $i";
						$query = mysqli_query($con, $q);

						while ($rows = mysqli_fetch_array($query) ) {
						 	?>

						 	<div class="card-body">
						 		
						 		<input type="radio" name="quizcheck[<?php echo $rows['ans_id']; ?>]" value="<?php echo $rows['aid']; ?>"> 
						 		<?php echo $rows['answer']; ?>

						 	</div>

					<?php
					}
				}
			}
				?>

				<input type="submit" name="submit" value="Submit" class="btn btn-success m-auto d-block">
			</form>
		</div>
				<div class="m-auto d-block">
				<a href="logout.php" class="btn btn-danger"> LOGOUT </a>
				</div>
			</div>
		</div>
	
</body>
</html>