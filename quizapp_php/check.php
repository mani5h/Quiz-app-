<?php
session_start();
   $con = mysqli_connect('localhost','root');
   	mysqli_select_db($con,'quizdb');
   ?>

<html>
   <head>
      <title></title>
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style type="text/css">
	.animateuse{
			animation: leelaanimate 0.5s infinite;
		}

@keyframes leelaanimate{
			0% { color: red },
			10% { color: yellow },
			20%{ color: blue }
			40% {color: green },
			50% { color: pink }
			60% { color: orange },
			80% {  color: black },
			100% {  color: brown }
		}
</style>

   </head>
   <body>
     <div class="container text-center" >
     	<br><br>
    	<h1 class="text-center text-success text-uppercase animateuse" >  QuiZapp </h1>
    	<br><br><br><br>
      <table class="table text-center table-bordered table-hover">
      	<tr>
      		<th colspan="2" class="bg-dark"> <h1 class="text-white"> Results </h1></th>
      		
      	</tr>
      	<tr>
		      	<td>
		      		Questions Attempted
		      	</td>

	         <?php
         $counter = 0;
         $Resultans = 0;
            if(isset($_POST['submit'])){
            if(!empty($_POST['quizcheck'])) {
            // Counting number of checked checkboxes.
            $checked_count = count($_POST['quizcheck']);
            // print_r($_POST);
            ?>

        	<td>
            <?php
            $q = " select * from questions ";

            $result = mysqli_query($con, $q);

            $n = mysqli_num_rows($result);
            echo "Out of ".$n.", You have attempt ".$checked_count." option."; ?>
            </td>
        
          	
            <?php
            // Loop to store and display values of individual checked checkbox.
            $selected = $_POST['quizcheck'];
            
            $q1= " select * from questions ";
            $ansresults = mysqli_query($con,$q1);
            $i = 1;
            while($rows = mysqli_fetch_array($ansresults)) {
            	$flag = $rows['ans_id'] == $selected[$i];
            	   
            			if($flag){
            				echo "correct ans is ".$rows['ans_id']."<br>";				
            				$counter++;
            				$Resultans++;
            				echo "Well Done! your ". $counter ." answer is correct <br><br>";
            			}else{
            				$counter++;
            				echo "Sorry! your ". $counter ." answer is innncorrect <br><br>";
            			}					
            		$i++;		
            	}
            	?>
            	
    		
    		<tr>
    			<td>
    				Your Total score
    			</td>
    			<td colspan="2">
	    	<?php 
	            echo " Your score is ". $Resultans.".";
	            }
	            else{
	            echo "<b>Please Select Atleast One Option.</b>";
	            }
	            } 
	          ?>
	          </td>
            </tr>

            <?php 
            $name = $_SESSION['username'];
            $id = $_SESSION['uid'];
            $q = " select totalques from user  where  uid=$id ";
            // echo "UIDUIDUIDUID IS ".$id;
            $result=mysqli_query($con,$q);
            $rows = mysqli_fetch_array($result,MYSQLI_NUM);
            $totq=$rows[0];
            
            $q = " select * from questions ";

            $result = mysqli_query($con, $q);

            $n = mysqli_num_rows($result);

            $tq=$totq+$n;
            // echo $tq." ".$totq." ".$n;

            $q = " select answerscorrect from user  where  uid=$id ";
            $result=mysqli_query($con,$q);
            $rows = mysqli_fetch_array($result,MYSQLI_NUM);
            $ansc=$rows[0];
            $correct=$Resultans+$ansc;
            $finalresult = " update user set totalques=$tq , answerscorrect=$correct where uid=$id";
            $queryresult= mysqli_query($con,$finalresult); 
           
            ?>
      </table>

      	<a href="logout.php" class="btn btn-success"> LOGOUT </a>
        <h2 class="text-center">ALL TIME STATS:</h2>
        <h4 class="text-center"> Total questions:<?php
        $q = " select totalques from user  where  uid=$id ";
            $result=mysqli_query($con,$q);
            $rows = mysqli_fetch_array($result,MYSQLI_NUM);
            $totq=$rows[0];
            echo $totq;
        ?></h4>
        <h4 class="text-center"> Correct answers:<?php
           $q = " select answerscorrect from user  where  uid=$id ";
           $result=mysqli_query($con,$q);
            $rows = mysqli_fetch_array($result,MYSQLI_NUM);
            $ansc=$rows[0];
           echo $ansc;
        ?></h4>
        <h4 class="text-center"> Accuracy:<?php
           echo $ansc/$totq;
        ?></h4>
        <br/>
        <h3 class="text-center">LEADERBOARD</h3>
      </div>
   </body>
</html>
