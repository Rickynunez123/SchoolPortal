
<style>
table, th, td {
 border: 1px solid black;
 border-collapse: collapse;
}
</style>
<?php
session_start();
require "db.php";
	 try {
		  $dbh = connectDB();
		  $statement = $dbh->prepare("SELECT  exam_name  , course_id , student_score FROM student_scores where student_id = :student_id"); 
		  $statement->bindParam("student_id",$_SESSION['id']);
		  $result = $statement->execute();
		  $accounts=$statement->fetchAll();
		  }catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		  }
	 

?>


 <table>
 <tr>
 <th>exam_name</th>
 <th>course id</th>
 <th>student_score</th>

 <?php
 foreach ($accounts as $row) {
 echo "<tr>";
 echo "<td>" . $row["exam_name"] . "</td>";
 echo "<td>" . $row["course_id"] . "</td>";
 echo "<td>" . $row["student_score"] . "</td>";
 echo "</tr>";
 }
	 echo "<table>";
//}
?>

