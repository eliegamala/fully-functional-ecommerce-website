<?php

include 'INCLUDES/connect.php';

// Starting a new session if none exists
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check if the user id is set in the session
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $email = $_POST['email']; // Corrected assignment
  $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Changed to FILTER_SANITIZE_EMAIL for better email sanitization

  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);

  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);

  $cpass = sha1($_POST['cpass']);
  $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

  $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? or number = ?");
  $select_user->execute([$email, $number]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if ($select_user->rowCount() > 0) {
    $message[] = 'Email or number is already taken';
  } else {
    if ($pass != $cpass) {
      $message[] = 'Confirm password does not match';
    } else {
      $insert_user = $conn->prepare("INSERT INTO `users` (name, email, number, password) VALUES (?, ?, ?, ?)");
      $insert_user->execute([$name, $email, $number, $cpass]);
      $confirm_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
      $confirm_user->execute([$email, $pass]);
      $row = $confirm_user->fetch(PDO::FETCH_ASSOC);

      if ($confirm_user->rowCount() > 0) {
        $_SESSION['user_id'] = $row['ID'];
        header('Location: index.php'); 
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <!-- Icon links -->
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

  <!-- Font Awesome CDN link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <!-- CSS links -->
  <link rel="stylesheet" href="css/styles.css" />
 <link rel="stylesheet" href="css/form-styles.css" />
</head>
<body>

<!-- Header section starts -->
<?php
include 'INCLUDES/user_header.php';
?>
<!-- Header section ends -->

<!-- Register section starts -->
<section class="form-container">

<form action="" method="post">

  <h3>Register now</h3>
  <input type="text" required maxlength="50" name="name" placeholder="Enter your name" class="box">
  <input type="email" required maxlength="50" name="email" placeholder="Enter your email" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
  <input type="number" name="number" required placeholder="Enter your number" class="box" min="0" max="9999999999" maxlength="10">
  <input type="password" required maxlength="20" name="pass" placeholder="Enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
  <input type="password" required maxlength="20" name="cpass" placeholder="Confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

  <input type="submit" value="Register now" class="hero-btn" name="submit">
  <p>Already have an account? <a href="login.php">Login now</a></p>
</form>
</section>


<!-- JavaScript -->
<script src="js/javascript.js" async defer></script>

</body>
</html>
