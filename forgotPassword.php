<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
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
        <h2 style="text-align: center;">Reset Password</h2>

      </header>
      <div class="block" >
        <div class="container" style="max-width: 640px;">
        
                <form>
                    <label for="email">Email</label>
                    <div class="input-group">
                    <input class = "input" type="password" name="email" placeholder="youremail@mtu.edu" required>
                    </div>

                    <p>Enter the email associated with your account, 
                      and we'll send you an email with a link to reset your password.
                    </p>
                <button class="btn btn--primary btn--block">Next</button>
                </form>
                
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
