<!--We need to get all the information from the db and display it-->
<style>
table, th, td {
 border: 1px solid black;
 border-collapse: collapse;
}
</style>
<?php
session_start();
require "db.php";

  $examName = $_SESSION['exams'][$_SESSION['ques']];
  $classID = $_SESSION['classID'][$_SESSION['sub']];
	 try {
		  $dbh = connectDB();
		  $statement = $dbh->prepare("SELECT * FROM student_scores where exam_name = :exam_name and course_id = :course_id ");
		  $statement->bindParam(":exam_name", $examName);
		  $statement->bindParam(":course_id", $classID);
		  $result = $statement->execute();
		  $accounts=$statement->fetchAll();
		  }catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		  }
	 

      print_r($_SESSION["exams"][$_SESSION['ques']]);
?>

<?php
	 try {
		  $dbh2 = connectDB();
		  $statement2 = $dbh2->prepare("SELECT min(student_score) as minimum, max(student_score) as maximum,avg(student_score) as average FROM student_scores where exam_name = :exam_name and course_id = :course_id ");
		  $statement2->bindParam(":exam_name", $examName);
		  $statement2->bindParam(":course_id", $classID);
		  $result2 = $statement2->execute();
		  $accounts2=$statement2->fetchAll();
		  }catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		  }
	 

?>

 <table>
 <tr>
 <th>minimum score</th>
 <th>maximum score</th>
 <th>average score</th>
 </tr>
 <?php
 foreach ($accounts2 as $row) {
 echo "<tr>";
 echo "<td>" . $row["minimum"] . "</td>";
 echo "<td>" . $row["maximum"] . "</td>";
 echo "<td>" . $row["average"] . "</td>";
 echo "</tr>";
 }
	 echo "<table>";
//}
?>
 <table>
 <tr>
 <th>start_time</th>
 <th>end_time</th>
 <th>exam_name</th>
 <th>course_id</th>
 <th>student_id</th>
 <th>student_score</th>
 </tr>
 <?php
 foreach ($accounts as $row) {
 echo "<tr>";
 echo "<td>" . $row["start_time"] . "</td>";
 echo "<td>" . $row["end_time"] . "</td>";
 echo "<td>" . $row["exam_name"] . "</td>";
 echo "<td>" . $row["course_id"] . "</td>";
 echo "<td>" . $row["student_id"] . "</td>";
 echo "<td>" . $row["student_score"] . "</td>";
 echo "</tr>";
 }
	 echo "<table>";
//}
?>

