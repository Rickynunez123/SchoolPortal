<html>
	<body>
		<?php
		session_start();
		require "db.php";
		?>


		<?php
			 if (!isset($_SESSION["username"])) {
				header("LOCATION:login.php");
			  }else {
				    echo '<p align="left"> Welcome '. $_SESSION["username"].'</p>';
		}
		?>
		<form method=post >
		<input type="text" name ="student_id"> :student_id</input>
<p></p>
		<input type="text" name ="student_username"> :student_username</input>
<p></p>
		<input type="text" name ="student_password"> :student_password</input>
<p></p>
		<button type="submit" name = "create_student"> create student</button>
		<button type="submit" name="logout">logout </button>
		</form>
		<?php
	 try {
		 $currenttime = date('Y-m-d H:i:s') ;
		  $dbh1 = connectDB();
		  $statement1 = $dbh1->prepare("insert into f_students values (:student_id, :username, sha2(:password,256),:datetime, :username)");
		  $statement1->bindParam(":datetime",$currenttime);
		  $statement1->bindParam(":student_id",$_POST['student_id']); 
		  $statement1->bindParam(":password",$_POST['student_password']); 
		  $statement1->bindParam(":username",$_POST['student_username']); 
		  $result1 = $statement1->execute();
		  }catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		  }

		if (isset($_POST["logout"])) {
		       	session_destroy();
			header("LOCATION:login.php");
		}	
		?>
		</body>
</html>

