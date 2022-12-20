<?PHP
  session_start();
require "db.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Exams Student </title>
    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <!-- Use styles -->
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--javascript animation-->

  </head>

<!-----------------------Header-------------------------->

   <header>


    <nav class="nav collapsible">
      <!--Give the extra class to make a colapsible component-->
      <a class="nav__brand" href="professorView.php"
        ><img
          class="mtu__image"
          src="images/HuskyIcon_TwoColor_adobe_express.svg"
          alt=""
      /></a>
      <ul class="list nav__list collapsible__content">
        <li class="nav__item"><a href="professorView.php">Home</a></li>
      </ul>
    </nav>





<!-----------------------Exam block-------------------------->


<h1>
<?php
      print_r($_SESSION["exams"][$_SESSION['ques']]);
  ?>
</h1>

<?php
//initialize database connection 
$mysqli = mysqli_connect("classdb.it.mtu.edu","sdbraggs" , "!p9TdWkR5heFewHN", "sdbraggs");

  //verify database connection succeeded
  if($mysqli -> connect_errno){
    //could not connect to the database 
    echo "Failed to connect";
    exit();
  }

  //display the exam name
  $examName = $_SESSION['exams'][$_SESSION['ques']];
  //dispaly the course id
  $classID = $_SESSION['classID'][$_SESSION['sub']];

  //get question description and correct answer 
  $queryClasses = "SELECT description, correct_answer FROM questions WHERE exam_name = '$examName' AND course_id = '$classID'";


  //query the code 
  $resultClasses = $mysqli -> query($queryClasses);


  //get data row[columnName]
  $_SESSION['questionDesc'] = array();
  $_SESSION['correct'] = array();
  $_SESSION['questions'] = array();

  //putting the values
  while($row = mysqli_fetch_assoc($resultClasses)){
    //printing and saving the classes code
    // session variable and database tables name
    $_SESSION['questionDesc'][] = $row['description'];
    $_SESSION['correct'][] = $row['correct_answer'];

  }

?>



<?php
  $count = 0;
  $countToDisplayAnswers = 1;
  foreach($_SESSION['questionDesc'] as $row){
  }
  while($count < count($_SESSION['questionDesc'])){

?>
<form  name="question" method="POST" action="submitquestions.php">
 
<div><div class= 'plan--classes'><div class='card card--secondary'><header class='card__header'><div class='card__body'><h2 style='text-align: center;'>
<?php
        $queryAnswers = "SELECT points_per_question FROM questions WHERE exam_name = '$examName' AND course_id = '$classID'  AND question_number = '$countToDisplayAnswers'";

        $resultAnswers = $mysqli -> query($queryAnswers);
	print_r("(");  
	print_r(mysqli_fetch_assoc($resultAnswers)["points_per_question"]);
  	print_r("p) ");
  	print_r($_SESSION['questionDesc'][$count]);        
?>
</h2></div></header></div></div></div>
<?php
        $queryAnswers = "SELECT answers FROM f_answers WHERE exam_name = '$examName' 
                                                    AND course_id = '$classID' 
                                                    AND question_number = '$countToDisplayAnswers'";

        $resultAnswers = $mysqli -> query($queryAnswers);
        $_SESSION['questions'] = array();

        $ccount = 0;//delete 
        while($row = mysqli_fetch_assoc($resultAnswers)){         
      //print_r($row);
          $_SESSION['questions'][] = $row['answers'];

        }
        $innerCount = 0;
        while($innerCount < count($_SESSION['questions'])){
?>
<div class= 'plan--classes'>
          <div class='card card--secondary'>
            <div class='card__body'>
	    <input type='radio' name="<?=$_SESSION['questionDesc'][$count]?>" value = "<?=$_SESSION['questions'][$innerCount]?>" style='margin-right: 10px'>

<?php print_r($_SESSION['questions'][$innerCount]);    
  $innerCount++;
?>
  </input></div> </div></div> 
      
<?php
} 

//print_r($_POST);
  $countToDisplayAnswers++; 
  $count++;
  }
  ?>
 <br><br><br><br>
<form method="post" action="submitquestions.php">
<button class="btn btn--primary btn--block">Submit</button>
</form>
<?php
?>

