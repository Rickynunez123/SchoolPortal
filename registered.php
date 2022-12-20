<?php
session_start();
require "db.php";

if($_POST['course']){
   print_r($_SESSION); 
   print_r($_POST['course']); 
	 try {
		  $dbh1 = connectDB();
		  $statement1 = $dbh1->prepare("select * from f_enrolled where C_ID = :course_id and S_ID = :student_id");
		  $statement1->bindParam(":course_id",$_POST['course']); 
		  $statement1->bindParam(":student_id",$_SESSION['id']); 
		  $result1 = $statement1->execute();
		  $row1 = $statement1->fetch();

		  if(!$row1[0]) {

		  $dbh = connectDB();
		  $statement = $dbh->prepare("insert into f_enrolled values (:course_id, :student_id)");
		  $statement->bindParam(":course_id",$_POST['course']); 
		  $statement->bindParam(":student_id",$_SESSION['id']); 
		  $result = $statement->execute();
		  }
		  }catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		  }
}
		header("LOCATION:studentView.php");

?>
