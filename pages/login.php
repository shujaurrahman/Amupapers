<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <?php require_once "../assets/fonts.php"?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form.css">
  </head>
  <body>
  <?php
  require_once "../includes/header.php";
  ?>
    <section class="form login">
    <div id="login">
        <div id="formLogin">

            <h1>Sign In →
            </h1>

          <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                  <div class="inputContainer">
                      <input type="text" class="inputLogin" placeholder=" " name="email">
                      <label class="labelLogin">Email</label>
                  </div>

                  <div class="inputContainer">
                      <input type="password" class="inputLogin" placeholder=" " name="password">
                      <label class="labelLogin">Password</label>
                  </div>

                  <div class="field button">
                  <input type="submit" class="submitButton" value="Sign In">
                  </div>
          </form>

            <div class="register">
            <span class="breaker">
                or 
            </span>    
                <a class="links" href="./register.php">Register</a>
            </div>
            <div class="register">
            <span class="breaker">
              <b>Fotgot password?</b>
            </span>  
            <a class="links" href="../pages/reset-pass.php">Reset Now</a>
            </div>

        </div>

  </section>
  </div>
  </body>
  <script src="../js/login.js"></script>
  <script src="../js/script.js" defer></script>

</html>