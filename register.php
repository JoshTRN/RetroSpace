<?php

  require 'config/config.php';
  require 'inc/form_handlers/registration_handler.php';
  require 'inc/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/registration.css">
  <title>Document</title>
</head>
<body>

  <form action="register.php" method="POST">
    <input type="email" name="log_email" placeholder="Email Address">
    <br>
    <input type="password" name="log_password" placeholder="Password">
    <br>
    <input type="submit" name ="login_button" value="Login">
    <br>

    <?php if (in_array("Email or password was incorrect<br>", $error_array)) echo "Email or password was incorrect<br>" ?>
  </form>

  <br><br>

  <form action="register.php" method="POST">

    <input type="text" name='reg_fname' placeholder='First Name' required>
    <?php if (in_array("Your first name must be be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be be between 2 and 25 characters<br>" ?>
    <br>
    
    <input type="text" name='reg_lname' placeholder='Last Name' required>
    <?php if (in_array("Your last name must be be between 2 and 25 character<br>", $error_array)) echo "Your last name must be be between 2 and 25 character<br>" ?>
    <br>

    <input type="email" name='reg_email' placeholder='Email' required>
    <br>
    <input type="email" name='reg_email2' placeholder='Confirm Email' required>
    <br>

    <?php if (in_array("Email is already in use.<br>", $error_array)) echo 'Email is already in use.<br>';
    elseif (in_array("Invalid email format<br>", $error_array)) echo "Email is in invalid format<br>"; 
    elseif (in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>" ?>
    <br>
    <input type="password" name='reg_password' placeholder='Password' required>
    <br>
    <input type="password" name="reg_password2" placeholder='Confirm Password' required>
    <br>
    <?php if (in_array("Your passwords do not mach<br>", $error_array)) echo "Your passwords do not mach<br>";
    elseif (in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>"; 
    elseif (in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>" ?>
    
    <input type="submit" name ="register_button" value="register">

    <br>
    <?php if(in_array("<span style='color: #14c800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14c800;'>You're all set! Go ahead and login!</span><br>" ?>
  </form>
</body>
</html>