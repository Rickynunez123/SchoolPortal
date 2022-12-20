<?PHP
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professor View</title>
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
      <a class="nav__brand" href="login.php"
        ><img
          class="mtu__image"
          src="images/HuskyIcon_TwoColor_adobe_express.svg"
          alt=""
      /></a>
      <ul class="list nav__list collapsible__content">
        <li class="nav__item"><a href="login.php">Logout</a></li>
      </ul>
    </nav>

    <nav class="block__header">
      <!-- login is the page that is coming from-->
      <h2>
      <?php
        echo "Welcome " .$_SESSION['name'];
      ?>
      </h2>
      
      </nav>
   </header>

<!-----------------------Login block-------------------------->

<?php

//initialize database connection 
$mysqli = mysqli_connect("classdb.it.mtu.edu","sdbraggs" ,"!p9TdWkR5heFewHN", "sdbraggs");

  //verify database connection succeeded
  if($mysqli -> connect_errno){
    //could not connect to the database 
    echo "Failed to connect";
    exit();
  }

  $id = $_SESSION['id'];
  $queryClasses = "SELECT C_ID, title FROM f_course WHERE taught = '$id'";
  //query the code 
  $result = $mysqli -> query($queryClasses);
  //get data row[columnName]
  $_SESSION['classTitle'] = array();
  $_SESSION['classID'] = array();
  //putting the values
  while($row = mysqli_fetch_assoc($result)){
    //printing and saving the classes code
    // session variable and database tables name
    $_SESSION['classID'][] = $row['C_ID'];
    $_SESSION['classTitle'][] = $row['title'];
  }

 ?>


  <?php
  $count = 0;
  while($count < count($_SESSION['classID'])){
  $temp  = $count;

  echo  "<form  name='professorView' method='POST' action=";
  $_SERVER['PHP_SELF'];
  echo ">
  
  <div >
     <div class='plan plan--classes'>
      <div class='card card--primary'>
      
        <header class='card__header'></header>
        
    <div class='card__body'>
            <h2 style='text-align: center;'>
        <label for = '$temp' ></label>
        <input type = 'hidden' name = 'subject' value = $count ></input>
        
        <input type = 'submit' style='border: none; background-color: transparent' name='temp' 
        value= ".$_SESSION["classID"][$count].$_SESSION["classTitle"][$count].">
        </input>
            </h2>
        </div>
      </div>
    </div>
 </div>
 </form>
";
 $count++;
}
 ?>


<?php
echo "<prev>";
// print_r($_SESSION);

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Run on form submit via POST
  // collect value of input field
  $buttonClickeds= $_POST['subject'];

  if($_POST['subject'] == 0){
    $_SESSION['sub'] = 0;
    print_r($_SESSION['sub']);
    header("Location: exams.php");
  }
  else if($_POST['subject'] == 1){
    $_SESSION['sub'] = 1;
    print_r($_SESSION['sub']);
    header("Location: exams.php");
  }
}
?>




<!--------------------------------------------------------->

<!--------------------Footer----------------->

<footer class="block block--dark footer">
  <div class="container grid footer__sections">
    <section class="collapsible footer__section">
      <header class="collapsible__header">
        <h2 class="collapsible__heading footer__heading">Item 2</h2>
          <svg class="icon icon--white collapsible__chevron">
            <use xlink:href="images/sprite.svg#chevron"></use>
          </svg>
        </span>
      </header>
      <div class="collapsible__content">
        <ul class="list">
          <li><a href="#">Lorem, ipsum.</a></li>
          <li><a href="#">Lorem ipsum dolor .</a></li>
          <li><a href="#">Lorem, ipsum dolor.</a></li>
        </ul>          </div>
    </section>
    <section class="collapsible footer__section">
      <header class="collapsible__header">
        <h2 class="collapsible__heading footer__heading">Item 3</h2>
          <svg class="icon icon--white collapsible__chevron">
            <use xlink:href="images/sprite.svg#chevron"></use>
          </svg>
        </span>
      </header>
      <div class="collapsible__content">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, doloremque!
      </div>
    </section>
    <section class="footer__brand">
      <img class="image__footer" src="images/HuskyIcon_TwoColor_adobe_express.svg" alt="">
      <p class="footer__brand">Copyright 2022 MTU</p>

    </section>        
  </div>
</footer>

    <script src="js/main.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>

