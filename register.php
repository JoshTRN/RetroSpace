<?php

  session_start();

  $con = mysqli_connect('localhost', 'root', 'bradleycabaret1234', 'retrospace');

  if(mysqli_connect_errno()) {

    echo "Failed to connect: " . mysqli_connect_errno();
  }

  $fname = ''; //first name
  $lname = '';
  $email = '';
  $email2 = '';
  $password = '';
  $password2 = '';
  $date = '';
  $error_array = [];

  if (isset($_POST['register_button'])) {


    //First Name
    $fname = strip_tags($_POST['reg_fname']);
    $fname = str_replace(' ', '', $fname);
    $fname = ucfirst(strtolower($fname));
    $_SESSION['reg_fname'] = $fname; // Stores first name into session variable.

    //Last name
    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname; // Stores last name into session variable.

    //Email
    $email = strip_tags($_POST['reg_email']);
    $email = str_replace(' ', '', $email);
    $email = ucfirst(strtolower($email));
    $_SESSION['reg_email'] = $email; // Stores last name into session variable.


    //Email 2
    $email2 = strip_tags($_POST['reg_email2']);
    $email2 = str_replace(' ', '', $email2);
    $email2 = ucfirst(strtolower($email2));
    $_SESSION['reg_email2'] = $email2; // Stores last name into session variable.


    //Password 
    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);

    $date = date("Y-m-d");
      
    if ($email === $email2) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        //check if email exists 
        $e_check = (mysqli_query($con, "SELECT email FROM users WHERE email='$email'"));

        $num_rows = mysqli_num_rows($e_check);

          if ($num_rows > 0) {
            echo "Email is already in use.";
          }
      } else {
        echo "Invalid format";
      }
    } else {
      echo "Emails don't match";
    }

    if(strlen($fname) > 25 || strlen($fname) < 2) {
      echo "Your first name must be be between 2 and 25 characters";
    }

    if(strlen($lname) > 25 || strlen($lname) < 2) {
      echo "Your last name must be be between 2 and 25 characters";
    }
    
    if($password != $password2) {
      echo "Your passwords do not mach";
    } else {

      if (preg_match('/[^A-Za-z0-9]/', $password)) {
        echo "Your password can only contain english characters or numbers";
      }
      if(strlen($password) > 30 or strlen($password) < 5) {
        echo "Your password must be between 5 and 30 characters";
      }
    }
    
  }

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  
  <form action="register.php" method="POST">
    <input type="text" name='reg_fname' placeholder='First Name' required>
    <br>
    <input type="text" name='reg_lname' placeholder='Last Name' required>
    <br>
    <input type="email" name='reg_email' placeholder='Email' required>
    <br>
    <input type="email" name='reg_email2' placeholder='Confirm Email' required>
    <br>
    <input type="password" name='reg_password' placeholder='Password' required>
    <br>
    <input type="password" name="reg_password2" placeholder='Confirm Password' required>
    <br>
    <input type="submit" name ="register_button" value="register">
  </form>
</body>
</html>