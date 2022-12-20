<?php
function connectDB()
{
	 $config = parse_ini_file("db.ini");
	  $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
	  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	   return $dbh;
}
//return number of rows matching the given user and passwd.
function authenticateStudent($user, $passwd) {
	 try {
		  $dbh2 = connectDB();
		  $statement2 = $dbh2->prepare("SELECT count(*) FROM f_students where username = :username and password = sha2(:passwd,256) ");
		  $statement2->bindParam(":username", $user);
		  $statement2->bindParam(":passwd", $passwd);
		  $result2 = $statement2->execute();
		  $row2=$statement2->fetch();
		  return $row2[0];
		      }catch (PDOException $e) {
			       print "Error!" . $e->getMessage() . "<br/>";
			        die();
			        }
}

function authenticateInstructor($user, $passwd) {
	 try {
		  $dbh1 = connectDB();
		  $statement1 = $dbh1->prepare("SELECT count(*) FROM f_instructor where username = :username and password = sha2(:passwd,256) ");
		  $statement1->bindParam(":username", $user);
		  $statement1->bindParam(":passwd", $passwd);
		  $result1 = $statement1->execute();
		  $row1=$statement1->fetch();
		  return $row1[0];
		      }catch (PDOException $e) {
			       print "Error!" . $e->getMessage() . "<br/>";
			        die();
			        }
}
function get_Instructor_info($user) {
	 try {
		  $dbh = connectDB();
		  $statement = $dbh->prepare("SELECT * FROM f_instructor where username = :username ");
		  $statement->bindParam(":username", $user);
		  $result = $statement->execute();
		  $row=$statement->fetch();
		  return $row;
		      }catch (PDOException $e) {
			       print "Error!" . $e->getMessage() . "<br/>";
			        die();
			        }
}
function get_student_info($user) {
	 try {
		  $dbh = connectDB();
		  $statement = $dbh->prepare("SELECT * FROM f_students where username = :username ");
		  $statement->bindParam(":username", $user);
		  $result = $statement->execute();
		  $row=$statement->fetch();
		  return $row;
		      }catch (PDOException $e) {
			       print "Error!" . $e->getMessage() . "<br/>";
			        die();
			        }
}
function student_start_exam($user,$exam, $course){
	 try {
		  $dbh = connectDB();
		  $statement = $dbh->prepare("SELECT * FROM student_scores where username = :username and exam_name =:exam_name and course_id = :course_id");
		  $statement->bindParam(":username", $user);
		  $statement->bindParam(":exam_name", $exam);
		  $statement->bindParam(":course_id", $course);
		  $result = $statement->execute();
		  $row=$statement->fetch();
		  return $row;
		      }catch (PDOException $e) {
			       print "Error!" . $e->getMessage() . "<br/>";
			        die();
			        }
}
function submit_student_answer($examName,$classID,$student_id,$question_number,$answer){

try {
	 $dbh = connectDB();
	  $statement = $dbh->prepare("insert into submission values( :question_number , :exam_name , :course_id , :student_id , :student_answers)");
 	$statement->bindParam(":question_number",$question_number); 
 	$statement->bindParam(":exam_name",$examName); 
 	$statement->bindParam(":course_id",$classID);
 	$statement->bindParam(":student_id",$student_id);
 	$statement->bindParam(":student_answers",$answer);
 	$statement->execute();
 	$dbh = null;
 } catch (PDOException $e) {
 print "Error!" . $e->getMessage() . "<br/>";
 die();
 }
}


function get_accounts($user)
{
	 //connect to database
	// //retrieve the data and display
try {
	 $dbh = connectDB();
	  $statement = $dbh->prepare("SELECT account_no, balance name FROM lab4_accounts where username = :username ");
 	$statement->bindParam(":username", $_SESSION['username']);
 	$statement->execute();
 	return $statement->fetchAll();
 	$dbh = null;
 } catch (PDOException $e) {
 print "Error!" . $e->getMessage() . "<br/>";
 die();
 }
};


?>
