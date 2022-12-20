<?PHP
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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

   <header>
    <nav class="nav collapsible">
      <!--Give the extra class to make a colapsible component-->
      <a class="nav__brand" href="/"
        ><img
          class="mtu__image"
          src="images/HuskyIcon_TwoColor_adobe_express.svg"
          alt=""
      /></a>
      <svg class="icon icon--white nav__toggler">
        <use xlink:href="images/sprite.svg#menu"></use>
      </svg>

    </nav>
   </header>

<!-----------------------Login block-------------------------->


<section class="block container block-domain">

<div>
    <div class="card card--primary">
      <header class="card__header">
        <h2 style="text-align: center;">Welcome to Michigan Tech!</h2>
        <h5 style="text-align: center;">Login to continue </h5>

      </header>

      <div class="block" >
        <div class="container" style="max-width: 640px;">
        
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <label for="username">Username:</label>
                    <div class="input-group">
                        <input class = "input" type="text" name="username" placeholder="Username" required>
                    </div>
                
                    
                    <label for="password">Password:</label>
                    <div class="input-group">
                    <input class = "input" type="password" name="password" placeholder="Password" required>
                    </div>
                    

                <button class="btn btn--primary btn--block">Login</button>
                </form>
                
                <div style="margin-top: 24px;"><a href="forgotPassword.php" style="margin-top: 16px">Forgot password?</a></div>
        </div>
    </div>


    </div>
  </div>
</section>


<!--------------------------------------------------------->

<!--------------------Footer----------------->

<footer class="block block--dark footer">
  <div class="container grid footer__sections">
    <section class="collapsible collapsible--expanded footer__section">
      <div class="collapsible__header">
        <h2 class="collapsible__heading footer__heading">Item 1</h2>
          <svg class="icon icon--white collapsible__chevron">
            <use xlink:href="images/sprite.svg#chevron"></use>
          </svg>
        </span>
      </div>
      <div class="collapsible__content ">
        <ul class="list">
          <li><a href="#">Lorem, ipsum.</a></li>
          <li><a href="#">Lorem ipsum dolor .</a></li>
          <li><a href="#">Lorem, ipsum dolor.</a></li>
        </ul>
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
<!---------------PHP CODE ---------------->
<?php

//utility function to display errors 
function alert($message){
  echo "<script> aler('$message');</script>";
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //collect values of input field 
  //varName and html type 
  $username = $_POST['username'];
  $password = $_POST['password'];

  //hashing password
  $hPassword = hash('sha256', $password, $username);

  //initialize database connection 
  $mysqli = mysqli_connect("classdb.it.mtu.edu","rnunezcu" , "Tsonga12345@", "test_db");

  //verify database connection succeeded
  if($mysqli -> connect_errno){
    //could not connect to the database 
    echo "Failed to connect";
    exit();
  }
  else{
  //echo "Connection success!";
  //check if there is 1 user with that username and password
  $queryStudent = "SELECT COUNT(*) FROM f_students WHERE username = '$username'
                  AND password = '$password'";

  $queryInstructor = "SELECT COUNT(*) FROM f_instructor WHERE username = '$username'
  AND password = '$password'";
  

  //execute sql query 
  $resultStudent = $mysqli -> query($queryStudent);
  $resultInstructor = $mysqli -> query($queryInstructor);

  /* Need to check if it is the first time login in!!! */
  /* Forgot password funtion  */

  //see if login is valid and redirect
  if($resultInstructor -> fetch_row()[0] > 0){
    $row = mysqli_fetch_assoc($resultInstructor);
    $_SESSION["LoginErrorStatus"] = 0;
    if ($row["type"] == 0) {
      //get name of instructor
      $username = "SELECT * FROM f_instructor WHERE username = '$username'
      AND password = '$password'";
      //query the code 
      $resultName = $mysqli -> query($username);
      //get data row[columnName]
      while($row = mysqli_fetch_assoc($resultName)){
        echo $row['name'];
        echo $row['U_ID'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['U_ID'];
      }
      //redirect
      header("Location: professorView.php");
    }
  }
  //check if is a student
  else if($resultStudent -> fetch_row()[0] > 0){
    $row = mysqli_fetch_assoc($resultStudent);
    $_SESSION["LoginErrorStatus"] = 0;
    if ($row["type"] == 0) {
    //get name of instructor
    $username = "SELECT name FROM f_student WHERE username = '$username'
    AND password = '$password'";
    //query the code 
    $resultName = $mysqli -> query($username);
    //get data row[columnName]
    while($row = mysqli_fetch_assoc($resultName)){
      echo $row['name'];
      $_SESSION['name'] = $row['name'];
    }
      //redicrect
      header("Location: professorView.php"); //change to users file
    }
  }
  else{
    $_SESSION["loginErrorStatus"] = 1;
    echo '<p style="color:red">incorrect username or password</p>';
  }
}
}
// user clicked the logout button */
if ( isset($_POST["logout"]) ) {
  session_destroy();
 }
 ?>

