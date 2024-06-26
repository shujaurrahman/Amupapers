<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
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

            <h1>Registered Email →
            </h1>

          <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                  <div class="inputContainer">
                      <input type="text" class="inputLogin" placeholder=" " name="email">
                      <label class="labelLogin">Email</label>
                  </div>

                  <div class="field button">
                  <input type="submit" class="submitButton" value="Reset">
                  </div>
          </form>

            <div class="register">
            <span class="breaker">
                or 
            </span>    
            </div>
            <div class="register">
            <span class="breaker">
              <b>Login instead?</b>
            </span>  
            <a class="links" href="../pages/login.php">Login Now</a>
            </div>

        </div>

  </section>
  </div>
  </body>
  <script src="../js/reset-pass.js"></script>
</html>