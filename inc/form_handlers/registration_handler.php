<?php


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
        $e_check = (mysqli_query($con, "SELECT email FROM Users WHERE email='$email'"));

        $num_rows = mysqli_num_rows($e_check);

          if ($num_rows > 0) {
            array_push($error_array, "Email is already in use.<br>");
          }
      } else {
        array_push($error_array, "Invalid email format<br>");
      }
    } else {
      array_push($error_array, "Emails don't match<br>");
    }

    if(strlen($fname) > 25 || strlen($fname) < 2) {
      array_push($error_array, "Your first name must be be between 2 and 25 characters<br>");
    }

    if(strlen($lname) > 25 || strlen($lname) < 2) {
      array_push($error_array, "Your last name must be be between 2 and 25 character<br>");
    }
    
    if($password != $password2) {
      array_push($error_array, "Your passwords do not mach<br>");
    } else {

      if (preg_match('/[^A-Za-z0-9]/', $password)) {
        array_push($error_array, "Your password can only contain english characters or numbers<br>");
      }
      if(strlen($password) > 30 or strlen($password) < 5) {
        array_push($error_array, "Your password must be between 5 and 30 characters<br>");
      }

      if(empty($error_array)) {
        $password = md5($password); // Encrypts password

        $username = strtolower($fname . "_" . $lname);

        $check_username_query = mysqli_query($con, "SELECT username FROM Users WHERE username='$username'");

        $i = 0;
        while(mysqli_num_rows($check_username_query) != 0) {
          $i++;
          $username = $username ."_" . $i;
          $check_username_query = (mysqli_query($conn, "SELECT username FROM Users WHERE username='$username'"));
        }

        // Profile picture assignment

        $pics =  scandir( 'assets/images/profile_pics/defaults');

        $rand = rand(3, count($pics));
        $profile_pic = 'assets/images/profile_pics/' . $pics[$rand];

        $query = mysqli_query($con, "INSERT INTO Users VALUES ('', '$fname', '$lname', '$email', '$username', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        
        array_push($error_array, "<span style='color: #14c800;'>You're all set! Go ahead and login!</span><br>");

        // Clear session variables

        $_SESSION['reg_fname'] = '';
        $_SESSION['reg_lname'] = '';
        $_SESSION['reg_email'] = '';
        $_SESSION['reg_email2'] = '';
      }
    }
  }
?>