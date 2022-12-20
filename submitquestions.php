<?php
session_start();
require "db.php";

  $examName = $_SESSION['exams'][$_SESSION['ques']];
  $classID = $_SESSION['classID'][$_SESSION['sub']];
  $student_id = $_SESSION['id'];
  $question_number=1;

 foreach($_POST as $row){
	submit_student_answer($examName,$classID,$student_id,$question_number,explode(":",$row)[0]);
	$question_number++;
  }
  header("LOCATION:studentView.php");
?>
