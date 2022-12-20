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
		  $statement = $dbh->prepare("SELECT C_ID,title FROM f_course"); 
		  $result = $statement->execute();
		  $accounts=$statement->fetchAll();
		  }catch (PDOException $e) {
			print "Error!" . $e->getMessage() . "<br/>";
			die();
		  }
	 

?>


 <table>
 <tr>
 <th>course id</th>
 <th>title </th>

 <?php
 foreach ($accounts as $row) {
 echo "<tr>";
 echo "<td>" . $row["C_ID"] . "</td>";
 echo "<td>" . $row["title"] . "</td>";
 echo "</tr>";
 }
	 echo "<table>";
//}
?>

<form action="registered.php" method="post">

 <?php
 foreach ($accounts as $row) {
 echo '<input type="submit" name="course" value="' . $row["C_ID"] . '"  />';
 }
	 echo "<table>";
//}
?>
<form/>
