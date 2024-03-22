<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Password</title>
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

            <h1>New Password →
            </h1>

          <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="inputContainer">
                      <input type="password" class="inputLogin" placeholder=" " name="password">
                      <label class="labelLogin">New Password</label>
                  </div>
                <div class="inputContainer">
                      <input type="password" class="inputLogin" placeholder=" " name="confirm_password">
                      <label class="labelLogin">Confirm New Password</label>
                  </div>

                  <div class="field button">
                  <input type="submit" class="submitButton" value="Change Password ">
                  </div>
          </form>



        </div>

  </section>
  </div>
  </body>
  <script src="../js/newpass.js"></script>
</html>