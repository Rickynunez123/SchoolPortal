<?PHP
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Exams</title>
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

   <!--Use underscore __ when things can not be outside certain block -->

   <?php

//initialize database connection 
$mysqli = mysqli_connect("classdb.it.mtu.edu","sdbraggs" ,'!p9TdWkR5heFewHN', "sdbraggs");

  //verify database connection succeeded
  if($mysqli -> connect_errno){
    //could not connect to the database e
    echo "Failed to connect";
    exit();
  }

  $id = $_SESSION['classID'][$_SESSION['sub']];

  $queryExams = "SELECT name FROM f_exam WHERE course_id = '$id'";
  //query the code 
  $result = $mysqli -> query($queryExams); 
  
  
  
  //get data row[columnName]
  $_SESSION['exams'] = array();
  //putting the values
  while($row = mysqli_fetch_assoc($result)){
    //printing and saving the classes code
    // session variable and database tables name
    $_SESSION['exams'][] = $row['name'];
  }
 ?>


<h2 style='text-align: center;'>
  <?php
    echo $_SESSION["classID"][$_SESSION['sub']].$_SESSION["classTitle"][$_SESSION['sub']];
  ?>
</h2>


<?php
  $count = 0;
  while($count < count($_SESSION['exams'])){

  echo  "<form  name='exams' method='POST' action=";
  $_SERVER['PHP_SELF'];
  echo ">
  <div >
     <div class='plan plan--classes'>
      <div class='card card--primary'>
        <header class='card__header'>
            <div class='card__body'>
              <h2 style='text-align: center;'>".$_SESSION['exams'][$count]."</h2>
            </div>
        </header>
               
        <div class='card__body'>



        <label for = '$count' >
        <input type = 'hidden' name = 'questions' value = $count >
        <button class='btn btn--outline btn--block'>Review Exam Problems</button>
        </input>
        </label>
        </form><br><br>
        <button class='btn btn--outline btn--block' name = 'btn' value ='data'>Exam Scores</button>

        </div>    
        </div>
      </div>
    </div>


    <div class='plan plan--classes'>
        <div class='card__body'>
          </div>
        </div>


";
 $count++;
}
 ?>

<!-- <div >
  <div class="plan--classes">
      <div class="card card--secondary">
        <header class="card__header">
            <div class="card__body">
                <h2 style="text-align: center;">Create Exam</h2>
            </div>
        </header>
        <div class="card__body">
        <button class="btn btn--outline btn--block">Go</button>
        </div>
      </div>
    </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br> -->


  <?php
echo "<prev>";
//debug
//print_r($_SESSION);

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Run on form submit via POST
  // collect value of input field
  $buttonClickeds= $_POST['questions'];


  if(isset($_POST['btn'])){
	if($_POST['questions'] == 0){
    		$_SESSION['ques'] = 0;
	}else if($_POST['questions'] == 1){
    		$_SESSION['ques'] = 1;
	}
    header("Location: examsResults.php");

  }
  else if($_POST['questions'] == 0){
    $_SESSION['ques'] = 0;
    header("Location: questions.php");
  }
  else if($_POST['questions'] == 1){
    $_SESSION['ques'] = 1;
   header("Location: questions.php");
  }
}
?>



  
      <script src="js/main.js"></script>
      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
      <script>
        AOS.init();
      </script>
    </body>
  </html>
  

  <?php
// echo "<prev>";
// print_r($_POST);
// print_r($_SESSION);
  ?>
